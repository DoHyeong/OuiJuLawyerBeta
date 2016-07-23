package ouijulawyer.project.soma.ouijulawyerbeta.View;

import android.app.Dialog;
import android.content.Intent;
import android.database.sqlite.SQLiteException;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.Environment;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextUtils;
import android.text.TextWatcher;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.orm.SugarContext;
import com.orm.query.Condition;
import com.orm.query.Select;

import java.io.File;
import java.io.FileOutputStream;

import ouijulawyer.project.soma.ouijulawyerbeta.Model.MyInfo;
import ouijulawyer.project.soma.ouijulawyerbeta.R;
import ouijulawyer.project.soma.ouijulawyerbeta.Structure.ContractUploadRepo;
import ouijulawyer.project.soma.ouijulawyerbeta.Structure.ContractUploadService;
import ouijulawyer.project.soma.ouijulawyerbeta.Structure.OuijuGlobal;
import ouijulawyer.project.soma.ouijulawyerbeta.Structure.SignImageUploadRepo;
import ouijulawyer.project.soma.ouijulawyerbeta.Structure.SignImageUploadService;
import retrofit.Callback;
import retrofit.RestAdapter;
import retrofit.RetrofitError;
import retrofit.client.Response;
import retrofit.mime.TypedFile;

public class NewContractActivity extends AppCompatActivity {
    private SignDialog my_signDialog;
    private SignDialog your_signDialog;
    private LoadingDialog loading;


    TextView my_name;
    TextView my_birth;
    TextView my_phone;
    TextView my_accout;
    MyInfo myinfo;

    Button btn_my;
    Button btn_your;

    ImageView img_my_sign;
    ImageView img_your_sign;


    ////////////////////////////////
    EditText balju_name;
    EditText balju_birth;
    EditText balju_phone;
    EditText balju_sangho;

    EditText project_name;
    EditText project_des;

    EditText contract_date;
    EditText contract_to;
    EditText contract_amount;
    EditText contract_chacksu;

    EditText bosu_date;
    EditText bosu_des;

    EditText byebye_des;
    EditText contract_plus;
    ////////////////////////////////


    TextView text_my_name2;
    Button btn_submit;

    TextView text_balju_name2;

    TypedFile mysignpath;
    TypedFile yoursignpath;

    ///////////////////////////////
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_new_contract);
        SugarContext.init(NewContractActivity.this);

        loading = new LoadingDialog(NewContractActivity.this, "로딩중", "Azure Japan West서버와 통신중입니다.");

        my_name = (TextView)findViewById(R.id.my_name_text);
        my_birth = (TextView)findViewById(R.id.my_birth_text);
        my_phone = (TextView)findViewById(R.id.my_phone_text);
        my_accout = (TextView)findViewById(R.id.my_account_text);


        btn_my = (Button)findViewById(R.id.btn_my_sign);
        btn_your = (Button)findViewById(R.id.btn_your_sign);

        img_my_sign = (ImageView)findViewById(R.id.img_my_sign);
        img_your_sign = (ImageView)findViewById(R.id.img_your_sign);


        btn_submit = (Button)findViewById(R.id.btn_submit);
        //////////////

        balju_name = (EditText)findViewById(R.id.balju_name);
        balju_birth = (EditText)findViewById(R.id.balju_birth);
        balju_phone = (EditText) findViewById(R.id.balju_phone);
        balju_sangho = (EditText)findViewById(R.id.balju_sangho);

        project_name = (EditText)findViewById(R.id.project_name);
        project_des = (EditText)findViewById(R.id.project_des);

        contract_date = (EditText)findViewById(R.id.contract_date);
        contract_to = (EditText)findViewById(R.id.contract_to);
        contract_amount = (EditText)findViewById(R.id.contract_amount);
        contract_chacksu = (EditText)findViewById(R.id.contract_chaksu);

        bosu_date = (EditText)findViewById(R.id.bosu_date);
        bosu_des = (EditText)findViewById(R.id.bosu_des);

        byebye_des = (EditText)findViewById(R.id.byebye_des);
        contract_plus = (EditText)findViewById(R.id.contract_plus);
        ////////////////////
        text_my_name2 = (TextView)findViewById(R.id.text_my_name2);
        text_balju_name2 = (TextView)findViewById(R.id.last_baljo_name);
        ////////////////////

        btn_my.setOnClickListener(new View.OnClickListener(){

            @Override
            public void onClick(View v) {
                my_signDialog = new SignDialog(NewContractActivity.this,
                        "서명패드", // 제목
                        "아래에 서명해주세요", // 내용
                        saveMySign, // 왼쪽 버튼 이벤트
                        myClose); // 오른쪽 버튼 이벤트
                my_signDialog.show();
            }
        });


        btn_your.setOnClickListener(new View.OnClickListener(){

            @Override
            public void onClick(View v) {
                your_signDialog = new SignDialog(NewContractActivity.this,
                        "서명패드", // 제목
                        "아래에 서명해주세요", // 내용
                        saveYourSign, // 왼쪽 버튼 이벤트
                        yourClose); // 오른쪽 버튼 이벤트
                your_signDialog.show();
            }
        });


        balju_name.addTextChangedListener(new TextWatcher() {
            @Override
            public void beforeTextChanged(CharSequence charSequence, int i, int i1, int i2) {

            }

            @Override
            public void onTextChanged(CharSequence charSequence, int i, int i1, int i2) {

            }

            @Override
            public void afterTextChanged(Editable editable) {
                text_balju_name2.setText(balju_name.getText());

            }
        });


        btn_submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                if(!((isNull(balju_name) && isNull(balju_birth)) && (isNull(balju_phone)) && (isNull(project_name) && isNull(project_des)) && (isNull(contract_date) && isNull(contract_to))
                        && (isNull(contract_amount) && isNull(contract_amount)) && (isNull(contract_chacksu) && isNull(bosu_date)) && (isNull(bosu_des) && isNull(byebye_des)) && (isNull(contract_plus)
                        && isNull(balju_sangho)))) {
                    return;

                }


                loading.show();
                try{
                    // NaverInfoService service = retrofit.create(NaverInfoService.class);
                    final RestAdapter retrofit = new RestAdapter.Builder()
                            .setEndpoint("http://ouijulawyer.azurewebsites.net")
                            .build();

                    final ContractUploadService service = retrofit.create(ContractUploadService.class);



                    service.listRepos("ContractAdd", OuijuGlobal.session, balju_name.getText().toString(), balju_birth.getText().toString(),balju_phone.getText().toString(), balju_sangho.getText().toString(), project_name.getText().toString(), project_des.getText().toString(), contract_date.getText().toString(),contract_to.getText().toString(),contract_amount.getText().toString(),contract_chacksu.getText().toString(),bosu_date.getText().toString(),bosu_des.getText().toString(),byebye_des.getText().toString(),contract_plus.getText().toString(), new Callback<ContractUploadRepo>() {

                        @Override
                        public void success(ContractUploadRepo contractUploadRepo, Response response) {
                            Log.d("aaaa1",contractUploadRepo.message);
                            Log.d("aaaa2",contractUploadRepo.success);

                            int a = Integer.parseInt(contractUploadRepo.success);
                            if (a == 1) {

                                String imsi_id = contractUploadRepo.message;

                                SignImageUploadService service2 = retrofit.create(SignImageUploadService.class);
                                service2.listRepos("SignImageUpload", imsi_id, mysignpath, yoursignpath, new Callback<SignImageUploadRepo>() {
                                    @Override
                                    public void success(SignImageUploadRepo signImageUploadRepo, Response response) {
                                        loading.dismiss();
                                        Log.d("aaaa4",response.toString());
                                        Intent intent = new Intent(NewContractActivity.this,MainActivity.class);
                                        startActivity(intent);
                                        finish();
                                    }

                                    @Override
                                    public void failure(RetrofitError error) {
                                        Log.d("aaaa5",error.toString());

                                    }
                                });

                            }else{//실패

                                Log.d("aaaa999","Aa");

                            }


                        }

                        @Override
                        public void failure(RetrofitError error) {
                            Log.d("aaaa2",error.toString());

                        }
                    });


                }catch (Exception e){
                    Log.d("aaaa3",e.toString());

                }
            }
        });



        try{
            myinfo  = new MyInfo();
            myinfo = MyInfo.findWithQuery(MyInfo.class, "select * from my_info where session = ?", OuijuGlobal.session).get(0);
            myinfo =  Select.from(MyInfo.class)
                    .where(Condition.prop("session").eq(OuijuGlobal.session))
                    .list().get(0);
            if(myinfo.account == null){
                goSubmitMyInfo();
            }

        }catch (SQLiteException e){//정보등록부터 하시오
            goSubmitMyInfo();

        }catch (IndexOutOfBoundsException e){
            goSubmitMyInfo();
        }catch (Exception e){

        }



        //1area

        my_name.setText(myinfo.name);
        my_birth.setText(myinfo.birth);
        my_phone.setText(myinfo.phone);
        my_accout.setText(myinfo.bank + "," + myinfo.account);

        ///////////
        text_my_name2.setText(myinfo.name);


    }


    boolean isNull(EditText text){
        if(TextUtils.isEmpty(text.getText()) || text.getText().equals(" ")){
            text.setError("필수입력값 입니다");
            return false;
        }else{
            return true;
        }
    }

    void goSubmitMyInfo(){
        Toast.makeText(NewContractActivity.this,"계약서 작성을 위해선 내 정보 등록이 필수입니다.",Toast.LENGTH_LONG).show();
        Intent intent = new Intent(NewContractActivity.this,MyInfoActivity.class);
        startActivity(intent);
        finish();
    }


    private String saveSign(Dialog dialog, String fileName) {
        // 1. 캐쉬(Cache)를 허용시킨다.
        // 2. 그림을 Bitmap 으로 저장.
        // 3. 캐쉬를 막는다.

        LinearLayout touchpad = (LinearLayout)dialog.findViewById(R.id.touchpad);
        touchpad.setDrawingCacheEnabled(true);
        Bitmap screenshot = Bitmap.createBitmap(touchpad.getDrawingCache());
        touchpad.setDrawingCacheEnabled(false);

        File dir =
                Environment.getExternalStoragePublicDirectory(Environment.DIRECTORY_PICTURES);
        // 폴더가 있는지 확인 후 없으면 새로 만들어준다.
        if(!dir.exists())
            dir.mkdirs();
        FileOutputStream fos;
        try {
            fos = new FileOutputStream(new File(dir, fileName+".ouiju"));
            screenshot.compress(Bitmap.CompressFormat.PNG, 100, fos);
            fos.close();
            //   Toast.makeText(this, "저장 성공", 0).show();

            Log.d("ggg",dir.toString());
            return dir.toString();
        } catch (Exception e) {

            Log.e("phoro","그림저장오류",e);
            return "fail";
            //  Toast.makeText(this, "저장 실패", 0).show();
        }
    }

    private View.OnClickListener saveMySign = new View.OnClickListener() {
        public void onClick(View v) {
            Toast.makeText(getApplicationContext(), "확인버튼 클릭",
                    Toast.LENGTH_SHORT).show();
            String path = saveSign(my_signDialog,"my")+"/my.ouiju";
            mysignpath = new TypedFile("multipart/form-data", new File(path));
            File imgFile = new  File(path);

            if(imgFile.exists()){

                Bitmap myBitmap = BitmapFactory.decodeFile(imgFile.getAbsolutePath());

                img_my_sign.setImageBitmap(myBitmap);

            }
            my_signDialog.dismiss();
        }
    };

    private View.OnClickListener saveYourSign = new View.OnClickListener() {
        public void onClick(View v) {
            Toast.makeText(getApplicationContext(), "확인버튼 클릭",
                    Toast.LENGTH_SHORT).show();
            String path = saveSign(your_signDialog,"your")+"/your.ouiju";
            yoursignpath = new TypedFile("multipart/form-data", new File(path));
            File imgFile = new  File(path);

            if(imgFile.exists()){

                Bitmap myBitmap = BitmapFactory.decodeFile(imgFile.getAbsolutePath());

                img_your_sign.setImageBitmap(myBitmap);

            }
            your_signDialog.dismiss();
        }
    };


    private View.OnClickListener myClose = new View.OnClickListener() {
        public void onClick(View v) {
            my_signDialog.dismiss();

        }
    };
    private View.OnClickListener yourClose = new View.OnClickListener() {
        public void onClick(View v) {
            your_signDialog.dismiss();

        }
    };

}
