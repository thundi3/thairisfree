function cleanWordContent(wordContent) {
//found at http://blogs.speerio.net/peerio/
wordDiv = document.createElement("DIV");
wordDiv.innerHTML = wordContent;
for (var i = 0; i < wordDiv.all.length; i++) {
  wordDiv.all[i].removeAttribute("className","",0);
  wordDiv.all[i].removeAttribute("style","",0);
}
wordContent = wordDiv.innerHTML;

wordContent = String(wordContent).replace(/<\\?\?xml[^>]*>/g,"");
wordContent = String(wordContent).replace(/<\/?o:p[^>]*>/g,"");
wordContent = String(wordContent).replace(/<\/?v:[^>]*>/g,"");
wordContent = String(wordContent).replace(/<\/?o:[^>]*>/g,"");
wordContent = String(wordContent).replace(/&nbsp;/g,"");//<p>&nbsp;</p>
wordContent = String(wordContent).replace(/<\/?SPAN[^>]*>/g,"");
wordContent = String(wordContent).replace(/<\/?FONT[^>]*>/g,"");
wordContent = String(wordContent).replace(/<\/?STRONG[^>]*>/g,"");
wordContent = String(wordContent).replace(/<\/?P[^>]*><\/P>/g,"");
wordContent = String(wordContent).replace(/<\/?H1[^>]*>/g,"");
wordContent = String(wordContent).replace(/<\/?H2[^>]*>/g,"");
wordContent = String(wordContent).replace(/<\/?H3[^>]*>/g,"");
wordContent = String(wordContent).replace(/<\/?H4[^>]*>/g,"");
wordContent = String(wordContent).replace(/<\/?H5[^>]*>/g,"");
wordContent = String(wordContent).replace(/<\/?H6[^>]*>/g,"");
return wordContent;
}


