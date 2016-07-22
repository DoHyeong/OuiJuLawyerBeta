package ouijulawyer.project.soma.ouijulawyerbeta.View;

import android.app.Dialog;
import android.content.Context;
import android.os.Bundle;
import android.view.WindowManager;
import android.widget.TextView;

import ouijulawyer.project.soma.ouijulawyerbeta.R;

/**
 * Created by KIM on 2016. 7. 23..
 */
public class LoadingDialog extends Dialog {


    private TextView mTitleView;
    private TextView mContentView;

    private String mTitle;
    private String mContent;

    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);






        // 다이얼로그 외부 화면 흐리게 표현
        WindowManager.LayoutParams lpWindow = new WindowManager.LayoutParams();
        lpWindow.flags = WindowManager.LayoutParams.FLAG_DIM_BEHIND;
        lpWindow.dimAmount = 0.8f;
        getWindow().setAttributes(lpWindow);

        setContentView(R.layout.activity_loading_dialog);

        mTitleView = (TextView) findViewById(R.id.txt_title);
        mContentView = (TextView) findViewById(R.id.txt_content);

        // 제목과 내용을 생성자에서 셋팅한다.
        mTitleView.setText(mTitle);
        mContentView.setText(mContent);

    }
    public LoadingDialog(Context context, String title, String content) {
        super(context, android.R.style.Theme_Translucent_NoTitleBar);
        this.mTitle = title;
        this.mContent = content;
    }


}
