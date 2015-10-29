function all_on(anz_pages,numg)
{
 var sg=numg.toString();
 for (i=0;i<anz_pages;i++)
 {
  var sp=i.toString();
  var name="n"+sp+sg;
  // just toggle between clicked and not clicked:
  // x=eval("document.settings."+name).click();
  // all on or off
  Z="document.settings."+name;
  if ( eval(Z).checked == false ) x=eval("document.settings."+name).click();
 }
 return true;
}

function all_off(anz_pages,numg)
{
 var sg=numg.toString();
 for (i=0;i<anz_pages;i++)
 {
  var sp=i.toString();
  var name="n"+sp+sg;
  Z="document.settings."+name;
  if ( eval(Z).checked == true ) x=eval("document.settings."+name).click();
 }
 return true;
}

function toggle(anz_pages,numg)
{
 var sg=numg.toString();
 for (i=0;i<anz_pages;i++)
 {
  var sp=i.toString();
  var name="n"+sp+sg;
  // just toggle between clicked and not clicked:
  x=eval("document.settings."+name).click();
 }
 return true;
}

function checkForm(anz_pages,numg,Lang)
{
 var sg=numg.toString();
 for (i=0;i<anz_pages;i++)
 {
  var count=0;
  for (j=0;j<numg;j++)
  {
   var sp=i.toString();
   var sg=j.toString();
   var name="n"+sp+sg;
   Z="document.settings."+name;
   if ( eval(Z).checked == true ) count=count+1;
  }
  if (count == 0)
  {
   switch (Lang)
   {
    case "DE":
        alert("FEHLER:\nNicht alle Seiten haben mindestens eine administrative Gruppe zugeordnet."); break;
    case "EN":
        alert("ERROR:\nnot all pages have at least one administrative group."); break;
    default:
        alert("ERROR:\nnot all pages have at least one administrative group."); break;
   }
   return false;
  }
 }
 return true;
}