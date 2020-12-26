
package com.summary;

import java.io.File;


public class CallApi {
    
    public StringBuilder getSummary(String path)
    {
    
		SummaryTool summary = new SummaryTool();
		summary.init(new File(path));
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
		StringBuilder builder= summary.printSummary();

		summary.printStats();
    
    return builder;
    }
    
}
