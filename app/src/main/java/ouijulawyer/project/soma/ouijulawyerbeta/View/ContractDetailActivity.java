package ouijulawyer.project.soma.ouijulawyerbeta.View;

import android.content.ContentResolver;
import android.content.Context;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.drawable.Drawable;
import android.net.Uri;
import android.os.Environment;
import android.provider.MediaStore;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.view.menu.ExpandedMenuView;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.Toast;

import com.squareup.picasso.Picasso;
import com.squareup.picasso.Target;

import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.OutputStream;

import ouijulawyer.project.soma.ouijulawyerbeta.R;
import ouijulawyer.project.soma.ouijulawyerbeta.Structure.GetContractImage;
import ouijulawyer.project.soma.ouijulawyerbeta.Structure.GetContractImageRepo;
import retrofit.Callback;
import retrofit.RestAdapter;
import retrofit.RetrofitError;
import retrofit.client.Response;
import uk.co.senab.photoview.PhotoViewAttacher;

public class ContractDetailActivity extends AppCompatActivity {


    private ImageView contractImage;
    private PhotoViewAttacher mAttacher;


//    private KakaoLink kakaoLink;
//    private KakaoTalkLinkMessageBuilder kakaoTalkLinkMessageBuilder;

    private String nowURL;
    private  LoadingDialog loading;
    ImageView btn_kakao;

    Button btn_save;
    ImageView btn_sms;

    Context context;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_contract_detail);

        context = getApplicationContext();

        contractImage = (ImageView)findViewById(R.id.img_contract);
         mAttacher = new PhotoViewAttacher(contractImage);
         mAttacher.setScale(mAttacher.getMediumScale());


        btn_save = (Button)findViewById(R.id.btn_save);
        btn_sms = (ImageView)findViewById(R.id.btn_sms);



        btn_sms.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                Picasso.with(context).load(nowURL).into(new Target() {
                    @Override
                    public void onBitmapLoaded(Bitmap bitmap, Picasso.LoadedFrom from) {
                        File dir =
                                Environment.getExternalStoragePublicDirectory(Environment.DIRECTORY_DCIM);
                        // 폴더가 있는지 확인 후 없으면 새로 만들어준다.
                        if(!dir.exists())
                            dir.mkdirs();

                        FileOutputStream fos;
                        try {

                            long now = System.currentTimeMillis();
                            Bitmap contractimg = bitmap;
                            fos = new FileOutputStream(new File(dir, "/" + now + ".png"));
                            contractimg.compress(Bitmap.CompressFormat.PNG, 100, fos);
                            fos.close();
                            String current = dir + "/" + now + ".png";

                            File path = new File(current);
                            Uri uri = Uri.fromFile(path);

                            Intent intent = new Intent(Intent.ACTION_SEND); //전송 메소드를 호출합니다. Intent.ACTION_SEND
                            intent.setType("image/*"); //jpg 이미지를 공유 하기 위해 Type을 정의합니다.
                            intent.putExtra(Intent.EXTRA_STREAM, uri); //사진의 Uri를 가지고 옵니다.
                            startActivity(Intent.createChooser(intent, "선택해주세요")); //Activity를 이용하여 호출 합니다.

                            context.deleteFile(current);

                        }catch (Exception e){

                        }


                    }

                    @Override
                    public void onBitmapFailed(Drawable errorDrawable) {

                    }

                    @Override
                    public void onPrepareLoad(Drawable placeHolderDrawable) {

                    }

                });
            }




        });

        btn_save.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                getTarget(context,nowURL);
            }
        });


        loading = new LoadingDialog(ContractDetailActivity.this, "로딩중", "Azure Japan West서버와 통신중입니다.");
        loading.show();


        RestAdapter retrofit = new RestAdapter.Builder()
                .setEndpoint("http://ouijulawyer.azurewebsites.net")
                .build();

        GetContractImage service = retrofit.create(GetContractImage.class);

        Intent intent = getIntent();
        String csid = intent.getExtras().getString("csid");


        service.listRepos("GetContractImage", csid, new Callback<GetContractImageRepo>() {
            @Override
            public void success(GetContractImageRepo getContractImageRepo, Response response) {

                String image = getContractImageRepo.file;
                nowURL = "http://ouijulawyer.azurewebsites.net/contract/"+image+".png";
                Picasso.with(getApplicationContext()).load(nowURL).fit().into(contractImage);
                loading.dismiss();

            }

            @Override
            public void failure(RetrofitError error) {
                Log.d("aaaa111",error.toString());
            }
        });
    }


    //target to save
    private void getTarget(Context context, final String url){


        Picasso.with(context).load(url).into(new Target() {
            @Override
            public void onBitmapLoaded(Bitmap bitmap, Picasso.LoadedFrom from) {



                File dir =
                        Environment.getExternalStoragePublicDirectory(Environment.DIRECTORY_DCIM);
                // 폴더가 있는지 확인 후 없으면 새로 만들어준다.
                if(!dir.exists())
                    dir.mkdirs();
                FileOutputStream fos;
                try {
                    long now = System.currentTimeMillis();
                    Bitmap contractimg = bitmap;
                    fos = new FileOutputStream(new File(dir, "/"+now+".png"));
                    contractimg.compress(Bitmap.CompressFormat.PNG, 100, fos);
                    fos.close();
                    String current = dir+"/"+now+".png";
                    galleryAddPic(current);

                    Toast.makeText(getApplicationContext(), "저장 성공", Toast.LENGTH_SHORT).show();

                } catch (Exception e) {
                    Toast.makeText(getApplicationContext(), "저장 실패", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onBitmapFailed(Drawable errorDrawable) {
                Toast.makeText(getApplicationContext(), "저장 실패", Toast.LENGTH_SHORT).show();
            }

            @Override
            public void onPrepareLoad(Drawable placeHolderDrawable) {

            }
        });
    }

    private void galleryAddPic(String current) { //갤러리 동기화
        Intent mediaScanIntent = new Intent(Intent.ACTION_MEDIA_SCANNER_SCAN_FILE);
        File f = new File(current);
        Uri contentUri = Uri.fromFile(f);
        mediaScanIntent.setData(contentUri);
        this.sendBroadcast(mediaScanIntent);
    }








}
