package ouijulawyer.project.soma.ouijulawyerbeta.View;

import android.app.Dialog;
import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.Canvas;
import android.graphics.Color;
import android.graphics.Paint;
import android.graphics.Path;
import android.os.Bundle;
import android.view.MotionEvent;
import android.view.View;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.LinearLayout;
import android.widget.TextView;

import ouijulawyer.project.soma.ouijulawyerbeta.R;

/**
 * Created by KIM on 2016. 7. 23..
 */
public class SignDialog extends Dialog {

    class Point {
        float x;
        float y;
        boolean isDraw;
        public Point(float x, float y, boolean isDraw) {
            this.x = x;
            this.y = y;
            this.isDraw = isDraw;
        }
    }


    private TextView mTitleView;
    private TextView mContentView;
    private Button mLeftButton;
    private Button mRightButton;
    private LinearLayout touchpad;
    private String mTitle;
    private String mContent;

    private View.OnClickListener mLeftClickListener;
    private View.OnClickListener mRightClickListener;


    private Paint mPaint;
    private Path mPath;


    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        // 다이얼로그 외부 화면 흐리게 표현
        WindowManager.LayoutParams lpWindow = new WindowManager.LayoutParams();
        lpWindow.flags = WindowManager.LayoutParams.FLAG_DIM_BEHIND;
        lpWindow.dimAmount = 0.8f;
        getWindow().setAttributes(lpWindow);

        setContentView(R.layout.activity_sign_dialog);

        mTitleView = (TextView) findViewById(R.id.txt_title);
        mContentView = (TextView) findViewById(R.id.txt_content);
        mLeftButton = (Button) findViewById(R.id.btn_left);
        mRightButton = (Button) findViewById(R.id.btn_right);
        touchpad = (LinearLayout)findViewById(R.id.touchpad);

        class MyView extends View {
            private Paint mPaint;

            public int width;
            public  int height;
            private Bitmap mBitmap;
            private Canvas mCanvas;
            private Path    mPath;
            private Paint   mBitmapPaint;
            Context _context;
            private Paint circlePaint;
            private Path circlePath;


            public MyView(Context context) {
                super(context);
                mPaint = new Paint();
                mPaint.setAntiAlias(true);
                mPaint.setDither(true);
                mPaint.setColor(Color.GREEN);
                mPaint.setStyle(Paint.Style.STROKE);
                mPaint.setStrokeJoin(Paint.Join.ROUND);
                mPaint.setStrokeCap(Paint.Cap.ROUND);
                mPaint.setStrokeWidth(12);

                _context=context;
                mPath = new Path();
                mBitmapPaint = new Paint(Paint.DITHER_FLAG);
                circlePaint = new Paint();
                circlePath = new Path();
                circlePaint.setAntiAlias(true);
                circlePaint.setColor(Color.BLUE);
                circlePaint.setStyle(Paint.Style.STROKE);
                circlePaint.setStrokeJoin(Paint.Join.MITER);
                circlePaint.setStrokeWidth(4f);
            }

            @Override
            protected void onSizeChanged(int w, int h, int oldw, int oldh) {
                super.onSizeChanged(w, h, oldw, oldh);

                mBitmap = Bitmap.createBitmap(w, h, Bitmap.Config.ARGB_8888);
                mCanvas = new Canvas(mBitmap);
            }

            @Override
            protected void onDraw(Canvas canvas) {
                super.onDraw(canvas);

                canvas.drawBitmap( mBitmap, 0, 0, mBitmapPaint);
                canvas.drawPath( mPath,  mPaint);
                canvas.drawPath( circlePath,  circlePaint);
            }

            private float mX, mY;
            private static final float TOUCH_TOLERANCE = 4;

            private void touch_start(float x, float y) {
                mPath.reset();
                mPath.moveTo(x, y);
                mX = x;
                mY = y;
            }

            private void touch_move(float x, float y) {
                float dx = Math.abs(x - mX);
                float dy = Math.abs(y - mY);
                if (dx >= TOUCH_TOLERANCE || dy >= TOUCH_TOLERANCE) {
                    mPath.quadTo(mX, mY, (x + mX)/2, (y + mY)/2);
                    mX = x;
                    mY = y;

                    circlePath.reset();
                    circlePath.addCircle(mX, mY, 30, Path.Direction.CW);
                }
            }

            private void touch_up() {
                mPath.lineTo(mX, mY);
                circlePath.reset();
                // commit the path to our offscreen
                mCanvas.drawPath(mPath,  mPaint);
                // kill this so we don't double draw
                mPath.reset();
            }

            @Override
            public boolean onTouchEvent(MotionEvent event) {
                float x = event.getX();
                float y = event.getY();

                switch (event.getAction()) {
                    case MotionEvent.ACTION_DOWN:
                        touch_start(x, y);
                        invalidate();
                        break;
                    case MotionEvent.ACTION_MOVE:
                        touch_move(x, y);
                        invalidate();
                        break;
                    case MotionEvent.ACTION_UP:
                        touch_up();
                        invalidate();
                        break;
                }
                return true;
            }
        }

        touchpad.addView(new MyView(getContext()));

        // 제목과 내용을 생성자에서 셋팅한다.
        mTitleView.setText(mTitle);
        mContentView.setText(mContent);

        // 클릭 이벤트 셋팅
        if (mLeftClickListener != null && mRightClickListener != null) {
            mLeftButton.setOnClickListener(mLeftClickListener);
            mRightButton.setOnClickListener(mRightClickListener);
        } else if (mLeftClickListener != null
                && mRightClickListener == null) {
            mLeftButton.setOnClickListener(mLeftClickListener);
        } else {

        }
    }

    // 클릭버튼이 하나일때 생성자 함수로 클릭이벤트를 받는다.
    public SignDialog(Context context, String title,
                      View.OnClickListener singleListener) {
        super(context, android.R.style.Theme_Translucent_NoTitleBar);
        this.mTitle = title;
        this.mLeftClickListener = singleListener;
    }

    // 클릭버튼이 확인과 취소 두개일때 생성자 함수로 이벤트를 받는다
    public SignDialog(Context context, String title,
                      String content, View.OnClickListener leftListener,
                      View.OnClickListener rightListener) {
        super(context, android.R.style.Theme_Translucent_NoTitleBar);
        this.mTitle = title;
        this.mContent = content;
        this.mLeftClickListener = leftListener;
        this.mRightClickListener = rightListener;
    }


}
