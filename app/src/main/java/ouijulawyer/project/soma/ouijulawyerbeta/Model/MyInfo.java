package ouijulawyer.project.soma.ouijulawyerbeta.Model;

import com.orm.SugarRecord;

/**
 * Created by KIM on 2016. 7. 23..
 */
public class MyInfo extends SugarRecord {
    public String session;
    public String name;
    public String phone;
    public String birth;
    public String bank;
    public String account;


    public MyInfo(){

    }

    public MyInfo(String session, String name, String phone, String birth,String bank,String account){
        this.session = session;
        this.name = name;
        this.phone = phone;
        this.birth = birth;
        this.bank = bank;
        this.account = account;
    }
}
