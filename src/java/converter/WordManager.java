
package converter;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import org.apache.poi.xwpf.extractor.XWPFWordExtractor;
import org.apache.poi.xwpf.usermodel.XWPFDocument;



public class WordManager {
    private String filePath;
    private String str;
    public String toText() throws Exception
    {
        try
        {
        XWPFDocument docs=new XWPFDocument(new FileInputStream(filePath));
        XWPFWordExtractor we=new XWPFWordExtractor(docs);
             str=we.getText();
             
             File file=new File("C:/Users/Snehil Sharma/Desktop/QBS2/web/Documents/temp.txt");
             if(file.exists())
             {
             file.delete();
             }
             
             
             
            FileOutputStream out=new FileOutputStream(file);
            byte[] b=str.getBytes();
            out.write(b);
            out.close();
        }
        catch(Exception e)
        {
            System.err.println(e);
        }
        return str;
    }
    public void setFilePath(String filepath)
        {
            this.filePath=filepath;

        }
}
