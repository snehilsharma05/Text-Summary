/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package fac;

import java.sql.Connection;
import java.sql.DriverManager;

/**
 *
 * @author HP
 */
public class Factory {
    
    public static Connection getCon()
    {
        Connection con=null;
        
        try{
        Class.forName("com.mysql.jdbc.Driver");
        con=DriverManager.getConnection("jdbc:mysql://localhost:3306/project","root","root");
        
        }
    catch(Exception e)
    {
    
        System.out.println("Error in Connection Factory: "+e);
    }
    
    return con;
    
    
    }
    
    
    
}
