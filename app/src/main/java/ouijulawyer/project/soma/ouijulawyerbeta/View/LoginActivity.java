package ouijulawyer.project.soma.ouijulawyerbeta.View;

import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.os.StrictMode;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.Toast;

import com.nhn.android.naverlogin.OAuthLogin;
import com.nhn.android.naverlogin.OAuthLoginHandler;
import com.nhn.android.naverlogin.ui.view.OAuthLoginButton;

import ouijulawyer.project.soma.ouijulawyerbeta.Model.NaverClass;
import ouijulawyer.project.soma.ouijulawyerbeta.R;

public class LoginActivity extends AppCompatActivity {

    private LoadingDialog loading;
    /**
     * client 정보를 넣어준다.
     */
    private static String OAUTH_CLIENT_ID = "oLrlu7lb3sMqQLg3p2BO";
    private static String OAUTH_CLIENT_SECRET = "brg0_9ncW6";
    private static String OAUTH_CLIENT_NAME = "외주변호사";


    private static OAuthLogin mOAuthLoginModule;
    private static Context mContext;

    private RelativeLayout policy_box;



    private OAuthLoginButton mOAuthLoginButton;


    ImageView naverLogin;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder().permitAll().build();
        StrictMode.setThreadPolicy(policy);

        loading = new LoadingDialog(LoginActivity.this, "로딩중", "Azure Japan West서버와 통신중입니다.");

        naverLogin = (ImageView)findViewById(R.id.btn_naverlogin);
        mContext = LoginActivity.this;
        mOAuthLoginModule = OAuthLogin.getInstance();
        mOAuthLoginModule.init(LoginActivity.this,OAUTH_CLIENT_ID,OAUTH_CLIENT_SECRET,OAUTH_CLIENT_NAME);

        naverLogin.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                loading.show();
                mOAuthLoginModule.startOauthLoginActivity(LoginActivity.this, mOAuthLoginHandler);
            }
        });

        policy_box = (RelativeLayout)findViewById(R.id.policy_box);


        policy_box.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent browserIntent = new Intent(Intent.ACTION_VIEW, Uri.parse("http://ouijulawyer.azurewebsites.net/policy.html"));
                startActivity(browserIntent);



            }
        });


    }

    /**
     * OAuthLoginHandler를 startOAuthLoginActivity() 메서드 호출 시 파라미터로 전달하거나 OAuthLoginButton
     객체에 등록하면 인증이 종료되는 것을 확인할 수 있습니다.
     */
    private OAuthLoginHandler mOAuthLoginHandler = new OAuthLoginHandler() {
        @Override
        public void run(boolean success) {
            if (success) {
                String accessToken = mOAuthLoginModule.getAccessToken(mContext);
                String refreshToken = mOAuthLoginModule.getRefreshToken(mContext);
                long expiresAt = mOAuthLoginModule.getExpiresAt(mContext);
                String tokenType = mOAuthLoginModule.getTokenType(mContext);

                NaverClass nClass = new NaverClass(tokenType,accessToken);

                String session = nClass.naverLogin();
                if(session == "0"){ //실패일경우
                    Toast.makeText(LoginActivity.this,"로그인실패",Toast.LENGTH_SHORT).show();
                }else{
                    loading.dismiss();
                    Intent intent = new Intent(LoginActivity.this,MainActivity.class);
                    startActivity(intent);
                    finish();
                }


                //Toast.makeText()

            } else {
                String errorCode = mOAuthLoginModule.getLastErrorCode(mContext).getCode();
                String errorDesc = mOAuthLoginModule.getLastErrorDesc(mContext);
                Toast.makeText(mContext, "errorCode:" + errorCode
                        + ", errorDesc:" + errorDesc, Toast.LENGTH_SHORT).show();
            }
        };
    };
}
