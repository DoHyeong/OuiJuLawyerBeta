package ouijulawyer.project.soma.ouijulawyerbeta.Structure;

import retrofit.Callback;
import retrofit.http.Multipart;
import retrofit.http.POST;
import retrofit.http.Part;
import retrofit.http.Path;
import retrofit.http.Query;
import retrofit.mime.TypedFile;

/**
 * Created by Kim on 2016-07-17.
 */
public interface SignImageUploadService {
    @Multipart
    @POST("/api/{api_name}.php")
    void listRepos(@Path("api_name") String api_name, @Part("imsi_id") String imsi_id, @Part("mysign") TypedFile mysign, @Part("yoursign") TypedFile yoursign, Callback<SignImageUploadRepo> value);
}
