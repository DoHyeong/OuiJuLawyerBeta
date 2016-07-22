package ouijulawyer.project.soma.ouijulawyerbeta.View;

import android.content.Intent;
import android.database.sqlite.SQLiteException;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.orm.SugarContext;
import com.orm.query.Condition;
import com.orm.query.Select;

import java.util.List;

import ouijulawyer.project.soma.ouijulawyerbeta.Model.MyInfo;
import ouijulawyer.project.soma.ouijulawyerbeta.R;
import ouijulawyer.project.soma.ouijulawyerbeta.Structure.EditMyInfoRepo;
import ouijulawyer.project.soma.ouijulawyerbeta.Structure.EditMyInfoService;
import ouijulawyer.project.soma.ouijulawyerbeta.Structure.GetMyInfoRepo;
import ouijulawyer.project.soma.ouijulawyerbeta.Structure.GetMyInfoService;
import ouijulawyer.project.soma.ouijulawyerbeta.Structure.OuijuGlobal;
import retrofit.Callback;
import retrofit.RestAdapter;
import retrofit.RetrofitError;
import retrofit.client.Response;

public class MyInfoActivity extends AppCompatActivity {

    LoadingDialog loading;

    EditText edit_name;
    EditText edit_birth;
    EditText edit_phone;
    EditText edit_bank;
    EditText edit_accout;
    Button btn_edit;
    Button btn_back;

    Intent intent;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_my_info);
        SugarContext.init(MyInfoActivity.this);


        loading = new LoadingDialog(MyInfoActivity.this, "로딩중", "Azure Japan West서버와 통신중입니다.");

        edit_name = (EditText)findViewById(R.id.user_name);
        edit_birth = (EditText)findViewById(R.id.user_birth);
        edit_phone = (EditText)findViewById(R.id.user_phone);
        edit_bank = (EditText)findViewById(R.id.user_bank);
        edit_accout = (EditText)findViewById(R.id.user_account);
        btn_edit = (Button) findViewById(R.id.btn_edit);
        btn_back = (Button)findViewById(R.id.btn_back);
        SugarContext.init(MyInfoActivity.this);

        String session = OuijuGlobal.session;


        List<MyInfo> myinfo2;
        intent = new Intent(MyInfoActivity.this,MainActivity.class);
        try{
            MyInfo myinfo  = new MyInfo();


            myinfo = MyInfo.findWithQuery(MyInfo.class, "select * from my_info where session = ?", OuijuGlobal.session).get(0);
            myinfo =  Select.from(MyInfo.class)
                    .where(Condition.prop("session").eq(OuijuGlobal.session))
                    .list().get(0);


            loading = new LoadingDialog(MyInfoActivity.this, "로딩중", "Azure Japan West서버와 통신중입니다.");

            edit_name.setText(myinfo.name);
            edit_birth.setText(myinfo.birth);
            edit_phone.setText(myinfo.phone);
            edit_bank.setText(myinfo.bank);
            edit_accout.setText(myinfo.account);


        }catch (SQLiteException e){ //쿼리가 없을경우 여기서 서버로 요청
            Log.d("abc",e.toString());
            RestAdapter retrofit = new RestAdapter.Builder()
                    .setEndpoint("http://ouijulawyer.azurewebsites.net")
                    .build();

            GetMyInfoService service = retrofit.create(GetMyInfoService.class);

            service.listRepos("GetMyInfo", OuijuGlobal.session, new Callback<GetMyInfoRepo>() {

                @Override
                public void success(GetMyInfoRepo getMyInfoRepo, Response response) {
                    edit_name.setText(getMyInfoRepo.my_name);
                    edit_birth.setText(getMyInfoRepo.my_birth);
                    edit_phone.setText(getMyInfoRepo.my_phone);
                    edit_bank.setText(getMyInfoRepo.my_bank);
                    edit_accout.setText(getMyInfoRepo.my_account);
                    Toast.makeText(MyInfoActivity.this,"서버에 저장되어 있는 정보를 불러왔습니다.꼭 등록버튼을 눌러주세요",Toast.LENGTH_LONG).show();
                }

                @Override
                public void failure(RetrofitError error) {

                    Log.d("abc2",error.toString());

                }
            });





        }catch (Exception e){

        }

        btn_back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(intent);
            }
        });

        btn_edit.setOnClickListener(new View.OnClickListener(){

            public void onClick(View v){
                loading.show();
                MyInfo myinfo3;
                //MyInfo.deleteAll(MyInfo.class);
                try{
                    MyInfo.findWithQuery(MyInfo.class, "select * from my_info where session = ?", OuijuGlobal.session).get(0).delete();
                }catch (Exception e){
                }

                try{
                    myinfo3 = new MyInfo(OuijuGlobal.session,edit_name.getText().toString(),edit_phone.getText().toString(),edit_birth.getText().toString(),edit_bank.getText().toString(),edit_accout.getText().toString());
                    myinfo3.save();

                    try{
                        // NaverInfoService service = retrofit.create(NaverInfoService.class);
                        RestAdapter retrofit = new RestAdapter.Builder()
                                .setEndpoint("http://ouijulawyer.azurewebsites.net")
                                .build();

                        EditMyInfoService service = retrofit.create(EditMyInfoService.class);

                        Log.d("aaaa",OuijuGlobal.session);

                        service.listRepos("EditMyInfo", OuijuGlobal.session, myinfo3.name, myinfo3.phone, myinfo3.birth, myinfo3.bank, myinfo3.account, new Callback<EditMyInfoRepo>() {
                            @Override
                            public void success(EditMyInfoRepo editMyInfoRepo, Response response) {

                                Log.d("aaaa119",editMyInfoRepo.message);
                                loading.dismiss();
                                startActivity(intent);

                            }

                            @Override
                            public void failure(RetrofitError error) {
                                Log.d("aaaa112",error.toString());
                            }
                        });


                    }catch (Exception e){
                        Log.d("aaaa3",e.toString());

                    }


                }catch (Exception e){
                    Log.d("aaaa5",e.toString());

                }




            }

        });
    }
}
