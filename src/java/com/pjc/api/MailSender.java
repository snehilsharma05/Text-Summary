
package com.pjc.api;

import java.util.Properties;
import javax.mail.Authenticator;
import javax.mail.Message;
import javax.mail.PasswordAuthentication;
import javax.mail.Session;
import javax.mail.Transport;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeMessage;


public class MailSender {
    
    Properties prop=null;
String emailid="responseno2@gmail.com";
String password="123456789rrns";
    public MailSender() {
    
    prop=new Properties();
    prop.put("mail.smtp.auth", "true");
    prop.put("mail.smtp.starttls.enable", "true");
    prop.put("mail.smtp.host", "smtp.gmail.com");
    prop.put("mail.smtp.port", "587");
//Server Configuration    
    
    }
    
    
    public boolean sendMail(String recipient,String subject,String text)
    {
        Authenticator auth=new Authenticator() {
            @Override
            protected PasswordAuthentication getPasswordAuthentication() {

               return new PasswordAuthentication(emailid, password);

            }
 };
        //Clinet Authnrtication
        
        
    try{
    
        Session gmail_session= Session.getInstance(prop,auth);
        
        Message msg=new MimeMessage(gmail_session);
        msg.setFrom(new InternetAddress(emailid));
        msg.setRecipients(Message.RecipientType.TO, InternetAddress.parse(recipient));
        msg.setSubject(subject);
        msg.setText(text);
        
        Transport.send(msg);
        
       return true; 
        
        
        
        
        
    
    }
    catch(Exception e)
    {
        e.printStackTrace();
    return false;
    }
    
    
    
    }
    
    
     
    
    
    
    
}
