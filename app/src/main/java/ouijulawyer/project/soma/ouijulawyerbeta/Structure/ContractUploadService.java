package ouijulawyer.project.soma.ouijulawyerbeta.Structure;

import retrofit.Callback;
import retrofit.http.Field;
import retrofit.http.FormUrlEncoded;
import retrofit.http.GET;
import retrofit.http.Multipart;
import retrofit.http.POST;
import retrofit.http.Part;
import retrofit.http.Path;
import retrofit.http.Query;
import retrofit.mime.TypedFile;

/**
 * Created by Kim on 2016-07-17.
 */
public interface ContractUploadService {

    @FormUrlEncoded
    @POST("/api/{api_name}.php")
        // void listRepos(@Path("api_name") String auth, @Query("type") String type, @Query("token") String token, Callback<NaverInfoRepo>value);
    //void listRepos(@Path("api_name") String api_name, @Query("session") String session, @Query("name") String name, @Query("phone") String phone, @Query("birth") String birth, @Query("bank") String bank, @Query("account") String accout, Callback<EditMyInfoRepo> value);
    void listRepos(@Path("api_name") String api_name, @Field("session") String session, @Field("balju_name") String balju_name, @Field("balju_birth") String birth, @Field("balju_phone") String balju_phone, @Field("balju_sangho") String balju_sangho, @Field("project_name") String project_name, @Field("project_des") String project_des, @Field("contract_date") String contract_date , @Field("contract_to") String contract_to, @Field("contract_amount") String contract_amount, @Field("contract_chacksu") String contract_chacksu, @Field("bosu_date") String bosudate, @Field("bosu_des") String bosu_des, @Field("byebye_des") String byebye_des, @Field("contract_plus") String contract_plus, Callback<ContractUploadRepo> value);
    //,    @Multipart @Part("mysign") TypedFile mysign, @Part("yoursign") TypedFile yoursign,

}
