package converter;

import java.io.*;
import org.apache.pdfbox.cos.COSDocument;
import org.apache.pdfbox.io.RandomAccessRead;
import org.apache.pdfbox.pdfparser.PDFParser;
import org.apache.pdfbox.pdmodel.PDDocument;
import org.apache.pdfbox.text.PDFTextStripper;

public class PDFManager {
private PDFParser parser;
private PDFTextStripper pdfStripper;
private PDDocument pdDoc;
private COSDocument cosDoc;
private String Text;
private String filePath;
private File file;
public PDFManager()
{
}
public String toText() throws IOException
{
this.pdfStripper=null;
this.pdDoc=null;
this.cosDoc=null;
pdDoc = PDDocument.load(new File(filePath));
pdfStripper = new PDFTextStripper();
pdDoc.getNumberOfPages();
pdfStripper.setStartPage(0);
pdfStripper.setEndPage(pdDoc.getNumberOfPages());
Text=pdfStripper.getText(pdDoc);
FileOutputStream out=new FileOutputStream("c:/temp/temp.txt");
byte[] b=Text.getBytes();
out.write(b);
out.close();
return Text;

}
public void setFilePath(String filepath)
{
this.filePath=filepath;

}
public PDDocument getPDDoc()
{
return pdDoc;
}



}
