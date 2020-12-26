
import java.io.*;
import java.io.FileInputStream;
import java.io.IOException;
import java.util.*;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.*;
import java.sql.DriverManager;
import java.sql.Statement;
import javax.servlet.*;
import javax.servlet.ServletException;
import javax.servlet.http.*;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;


public class RegisterServlet extends HttpServlet {

    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        PrintWriter out = response.getWriter();
        
	Connection con=null;
	Statement stmt=null;
       // FileInputStream input=null;
      
String name=request.getParameter("name");
String email=request.getParameter("email");
String password=request.getParameter("password");
String address=request.getParameter("address");
String contact=request.getParameter("contact");
String age=request.getParameter("age");
String gender=request.getParameter("gender");
String stream=request.getParameter("stream");

int a=2;


List l=new LinkedList();
if(name.length()==0)
{
    l.add("1");
}
if(email.length()==0)
{
    l.add("2");
}

if(password.length()==0)
{
    l.add("3");
}
if(address.length()==0)
{
    l.add("4");
}
if(contact.length()==0)
{
    l.add("5");
}
if(age.length()==0)
{
    l.add("6");
}
if(gender.length()==0)
{
    l.add("7");
}
if(stream.length()==0)
{
    l.add("8");
}
if(!l.isEmpty())
{
request.setAttribute("error",l);
RequestDispatcher rd=request.getRequestDispatcher("register.jsp");
rd.forward(request,response);
}
if(l.isEmpty())
{
try
{
	Driver d1=new com.mysql.jdbc.Driver();
	DriverManager.registerDriver(d1);
		//Class.forName("com.mysql.jdbc.Driver");
		con=DriverManager.getConnection("jdbc:mysql://localhost:3306/project","root","root");
                                stmt=con.createStatement();
					
                            int nore=stmt.executeUpdate("insert into users(name,email,password,address,contact,age,gender,stream,role) values('"+name+"','"+email+"','"+password+"','"+address+"','"+contact+"','"+age+"','"+gender+"','"+stream+"','"+a+"')");
                         if(nore>0)
                         {
                              
                                 request.setAttribute("status", "Successfully Registered!");
                                 RequestDispatcher rd=request.getRequestDispatcher("userLogin.jsp");
                                 rd.forward(request, response);
                         }

}
	catch(Exception e)
	{
		out.println(e);
	}

try{
stmt.close();	
con.close();
}
catch(Exception e)
{
	System.out.println(e);
}

        }
    
    }
     @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

   
}

