package ouijulawyer.project.soma.ouijulawyerbeta.Controller;

import android.content.Context;
import android.graphics.Camera;
import android.graphics.Matrix;
import android.util.AttributeSet;
import android.util.Log;
import android.view.View;
import android.view.animation.Transformation;
import android.widget.Gallery;

/**
 * Created by KIM on 2016. 7. 23..
 */
public class ContractGallery extends Gallery {


    private static Camera mCamera;
    public ContractGallery(Context context) {
        this(context,null);
    }

    public ContractGallery(Context context, AttributeSet attrs){
        this(context,attrs,0);
    }

    public ContractGallery(Context context, AttributeSet attrs, int defStyle){
        super(context, attrs, defStyle);
        mCamera = new Camera();
        setSpacing(-40);
    }

    protected boolean getChildStaticTransformation(View child, Transformation t) {
        final int mCenter = (getWidth() - getPaddingLeft() - getPaddingRight()) / 2 + getPaddingLeft();
        final int childCenter = child.getLeft() + child.getWidth() / 2;
        final int childWidth = child.getWidth();

        t.clear();
        t.setTransformationType(Transformation.TYPE_MATRIX);
        float rate = Math.abs((float) (mCenter - childCenter) / childWidth);

        mCamera.save();
        final Matrix matrix = t.getMatrix();
        float zoomAmount = (float) (rate * 200.0);
        mCamera.translate(0.0f, 0.0f, zoomAmount);
        mCamera.getMatrix(matrix);
        matrix.preTranslate(-(childWidth / 2), -(childWidth / 2));
        matrix.postTranslate((childWidth / 2), (childWidth / 2));
        mCamera.restore();

        Log.d("trans","now");

        return true;
    }

}
