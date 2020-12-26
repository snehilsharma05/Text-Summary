/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controller;

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.LinkedList;
import java.util.List;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

public class userAuthentication extends HttpServlet {

    
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        PrintWriter out = response.getWriter();
        String email=request.getParameter("name");
                String password =request.getParameter("password");
        String roleAdmin="1";
        String roleUser="2";
        String role="";
        int id=0;
        List l=new LinkedList();
if(email.length()==0)
{
    l.add("1");
}
if(password.length()==0)
{
    l.add("2");
}
        if(!l.isEmpty())
{
request.setAttribute("error1",l);
RequestDispatcher rd=request.getRequestDispatcher("userLogin.jsp");
rd.forward(request,response);
}
if(l.isEmpty())
{
        
        try  {
        
        		  Connection con=fac.Factory.getCon();
                              Statement  stmt=con.createStatement();
								
                           ResultSet  rs=stmt.executeQuery("select * from users where status=1");
                             String username=null;
                             while(rs.next())
                             {
                              if((rs.getString(3)).equals(email)&&(rs.getString(4)).equals(password)&&(rs.getString(10).equals(roleUser)))
                             { 
                                id=rs.getInt(1);
                                 role=rs.getString(10);
                                  username=rs.getString(2);
                              }
                              else if((rs.getString(3)).equals(email)&&(rs.getString(4)).equals(password)&&(rs.getString(10).equals(roleAdmin)))
                             {
                                
                                 id=rs.getInt(1);
                                 role=rs.getString(10);
                                  username=rs.getString(2);
                              }
                              
                             }
	                  if(username!=null &&role.equals(roleUser))
                             {
                               HttpSession session=request.getSession();
                                session.setAttribute("admin_session",username);
                               session.setAttribute("id", id+"");
                               session.setAttribute("name", username);
                               
                               // RequestDispatcher rd=request.getRequestDispatcher("userHome.jsp");
                                //rd.forward(request, response);
                                int nore=stmt.executeUpdate("insert into userlogin(id) values('"+id+"')");
                                response.sendRedirect("userHome.jsp");
                                 
                             }
                          else if(username!=null &&role.equals(roleAdmin))
                          {
                                 HttpSession session=request.getSession();
                                session.setAttribute("admin_session2",username);
                                session.setAttribute("name", username);
                                session.setAttribute("id", id+"");
                                 response.sendRedirect("adminHome.jsp");
                              
                          }
                             else
                             {
                                out.println("Enter correct details");
                                 response.sendRedirect("userLogin.jsp");
                                 request.setAttribute("error", "Invalid Credentials !");
                                 RequestDispatcher rd=request.getRequestDispatcher("userLogin.jsp");
                                 rd.forward(request, response);
                                 
                             }
                                 

        
        
        
        
        }
        catch(Exception e)
        {}
}
    
}
    

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
