package ouijulawyer.project.soma.ouijulawyerbeta.Structure;

import retrofit.http.GET;
import retrofit.http.Path;
import retrofit.http.Query;

/**
 * Created by Kim on 2016-07-14.
 */
public interface NaverLoginService {
    @GET("/api/{api_name}.php")
    NaverLoginRepo listRepos(@Path("api_name") String api_name, @Query("user_id") String user_id);
}
