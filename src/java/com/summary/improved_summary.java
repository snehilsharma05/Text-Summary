package com.summary;
import java.io.File;
import javafx.stage.FileChooser;
import javax.swing.JFileChooser;

class improved_summary{
	public static void main(String[] args){
            
            JFileChooser chooser=new JFileChooser();
            chooser.showOpenDialog(null);
            File file= chooser.getSelectedFile();
            
            
            
		SummaryTool summary = new SummaryTool();
		summary.init(file);
		summary.extractSentenceFromContext();
		summary.groupSentencesIntoParagraphs();
		summary.printSentences();
		summary.createIntersectionMatrix();

		//System.out.println("INTERSECTION MATRIX");
		//summary.printIntersectionMatrix();

		summary.createDictionary();
		//summary.printDicationary();

		System.out.println("SUMMMARY");
		summary.createSummary();
		summary.printSummary();

		summary.printStats();
	}
}