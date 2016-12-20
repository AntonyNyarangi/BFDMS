function printcontent(el){
  var restorepage = document.body.innerHTML;
  var content2print = document.getelElementById(el).innerHTML;
  document.body.innerHTML = content2print;
  window.print();
  document.body.innerHTML = restorepage;
}
