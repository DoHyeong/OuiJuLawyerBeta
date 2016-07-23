package ouijulawyer.project.soma.ouijulawyerbeta.View;

import android.Manifest;
import android.content.Intent;
import android.content.pm.PackageInfo;
import android.content.pm.PackageManager;
import android.support.v4.app.ActivityCompat;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

import ouijulawyer.project.soma.ouijulawyerbeta.R;


public class SplashActivity extends AppCompatActivity {
    String [] permissions = {
            "android.permission.READ_PHONE_STATE",
            Manifest.permission.WRITE_EXTERNAL_STORAGE,
            Manifest.permission.READ_EXTERNAL_STORAGE,
    };

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);
        if(checkPermission() == false){
            ActivityCompat.requestPermissions(this,
                    permissions,101); // define this constant yourself
        }else{

            Intent intent = new Intent(SplashActivity.this,LoginActivity.class);
            startActivity(intent);
            finish();
        }
    }

    public void onRequestPermissionsResult(int requestCode, String[] permissions, int[] grantResults) {
        if(requestCode==101){

            if(!checkPermission()){
                ActivityCompat.requestPermissions(this,
                        permissions,
                        101); // define this constant yourself
            }else{

                 Intent intent = new Intent(SplashActivity.this,LoginActivity.class);
                startActivity(intent);
            }
        }
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
    }


    boolean checkPermission(){
        try{
            PackageManager manager = this.getPackageManager();
            PackageInfo info = manager.getPackageInfo(this.getPackageName(), 0);

        }catch (Exception e){

        }

        for(String permission : permissions){

            try {
                int permissionCheck = android.support.v4.app.ActivityCompat.checkSelfPermission(SplashActivity.this,
                        permission);
                if (permissionCheck != PackageManager.PERMISSION_GRANTED) {
                    return false;
                }
            }
            catch (Exception err) {
                err.printStackTrace();
                return false;
            }
        }
        return true;
    }
}
