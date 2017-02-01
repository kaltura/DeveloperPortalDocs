---
layout: null
sitemap: false
---
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript" src="{{ site.url }}/js/webflow.full.js"></script>
<script>
function show_hide_sub_div(div_id) 
{
    for (var $i = 0, $j = document.getElementById(div_id).getElementsByClassName('sidenav-sub-links'); $i < $j.length; $i++) {
            if ( $j[$i].style.visibility == 'hidden'){
                    $j[$i].style.visibility = 'visible';
                    $j[$i].style.display = 'block';
            }else{
                 $j[$i].style.visibility = 'hidden';
                 $j[$i].style.display = 'none';
            }
    }
}
function addRow(cat,subcat,name,link, entry_path) 
{
    if (subcat){
        // subcat handle
        sid=subcat.replace(" ", "");
        subcatel=document.getElementById(sid);
        // if there isn't one
        if (! subcatel ){
            var subcatel = document.createElement('div');
            subcatel.className = 'sidenav-grp-7';
            subcatel.id=subcat.replace(" ", "");
            subcatel.innerHTML = '<a href="#" class="sidenav-sub-cat-links" onClick="show_hide_sub_div(\''+subcatel.id + '\')"><h4 class="sidenav-headings grp-heading '+entry_path+'">'+subcat+'</h4></a>';
        }
        //subcatel.innerHTML = subcatel.innerHTML + '<a href='+link + ' class="sidenav-sub-links" id='+entry_path+'>'+name+'</a>';  
        var new_elem = document.createElement('div');
        new_elem.className = 'sidenav-sub-links';
        new_elem.innerHTML = '<a href='+link + ' class="sidenav-sub-links" id='+entry_path+'>'+name+'</a>'
        subcatel.appendChild(new_elem);
        document.getElementById(cat).getElementsByClassName('sidenav-grp-links')[0].appendChild(subcatel);
    }else{
        thecat=document.getElementById(cat.replace(" ", "")+'-sub');
        thecat.innerHTML = thecat.innerHTML + '<a href='+link + ' class="sidenav-links" id='+entry_path+'>'+name+'</a>' ;  
    }
}  

</script>
{% assign cats = site.cats | sort %}
{% for cat_hash in cats %}
{% assign cats_string = cat_hash[0] | split:"::" %}
<div class="sidenav-grp-7 heading-close" id="/{{ cats_string[1] }}" weight="{{ cats_string[0] }}">
        <a href="#" class="sidenav-cat-links" onClick="show_hide_div('/{{ cats_string[1] }}')"><h4 class="sidenav-headings grp-heading {{ cats_string[1] }}">{{ cat_hash[1] }}</h4></a>
        <div class="sidenav-grp-links" id="/{{ cats_string[1] | replace: ' ','' }}-sub" style="visibility: hidden; display: none;">
        {% capture dir %}{{ cats_string[1] }}{% endcapture %}
        {% capture cat %}{{ cat_hash[1] }}{% endcapture %}
        {% include nav.html context=dir catname=cat %}

        </div>
        </div>
{% endfor %}
