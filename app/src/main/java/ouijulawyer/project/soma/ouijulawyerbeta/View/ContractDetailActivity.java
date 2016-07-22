package ouijulawyer.project.soma.ouijulawyerbeta.View;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;

import com.squareup.picasso.Picasso;

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

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_contract_detail);
        contractImage = (ImageView)findViewById(R.id.img_contract);
         mAttacher = new PhotoViewAttacher(contractImage);
         mAttacher.setScale(mAttacher.getMediumScale());

        btn_kakao = (ImageView)findViewById(R.id.btn_kakao);
        btn_kakao.setClickable(false);

        btn_kakao.setOnClickListener(new View.OnClickListener(

        ) {
            @Override
            public void onClick(View view) {
//                try {
//                    kakaoLink = KakaoLink.getKakaoLink(getApplicationContext());
//                    kakaoTalkLinkMessageBuilder = kakaoLink.createKakaoTalkLinkMessageBuilder();
//                } catch (Exception e) {
//                    e.printStackTrace();
//                }
//
//                try {
//                    kakaoTalkLinkMessageBuilder.addText("외주변호사에서 작성된 계약서 입니다");
//                    kakaoTalkLinkMessageBuilder.addImage(nowURL, 496, 293);
//                    kakaoTalkLinkMessageBuilder.addWebLink("이미지크게 보기", nowURL);
//
//                    kakaoLink.sendMessage(kakaoTalkLinkMessageBuilder.build(), view.getContext());
//                } catch (KakaoParameterException e) {
//                    e.printStackTrace();
//                }
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
                btn_kakao.setClickable(true);

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




}
