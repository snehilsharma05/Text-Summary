
package controller;

import converter.PDFManager;
import converter.WordManager;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;


public class Converter extends HttpServlet {
   private String filePath;
public void init( ){
      
      filePath = getServletContext().getInitParameter("file-upload"); 
   }
   
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException, Exception {
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
          
            
                String filename= request.getParameter("doc_path");
                
   String words[]=filename.split("\\.");
   String ext=words[1];
   
   
   
   
            System.err.println("Data....   "+filename+"  "+ext);
   
    request.setAttribute("ext", ext);
    if(ext.equalsIgnoreCase("pdf"))
    {
                  PDFManager pdfManager=new PDFManager();
                pdfManager.setFilePath(filePath+filename);
                String text=pdfManager.toText();
             System.err.println("ho gyaaaaaaaaaaaaaaaa");
  
                RequestDispatcher rd=request.getRequestDispatcher("summaryResult.jsp");
             rd.forward(request, response);
           
    }
    else if(ext.equalsIgnoreCase("docx"))
    {
            WordManager word=new WordManager();
            word.setFilePath(filePath+filename);
                       String text1=word.toText();
       RequestDispatcher rd=request.getRequestDispatcher("DocumentSummary.jsp");
             rd.forward(request, response);
           
    }      
            else
             {
                 
                 
              request.setAttribute("path", filePath+filename);
                 RequestDispatcher rd=request.getRequestDispatcher("summaryResult.jsp");
             rd.forward(request, response);
             }       
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
        try {
            processRequest(request, response);
        } catch (Exception ex) {
            Logger.getLogger(Converter.class.getName()).log(Level.SEVERE, null, ex);
        }
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
        try {
            processRequest(request, response);
        } catch (Exception ex) {
            Logger.getLogger(Converter.class.getName()).log(Level.SEVERE, null, ex);
        }
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
