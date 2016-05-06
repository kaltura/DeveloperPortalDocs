---
layout: page
title: Site Categories
---

{% capture html %}
<ul>
{% assign cats = site.cats | sort %}
    {% for cat_hash in cats %}
	<li><a href="{{ cat_hash[0] }}">{{ cat_hash[1] }} </a></li>
    {% endfor %}
</ul>
{% endcapture %} {{ html | strip_newlines | replace:'    ','' | replace:'    ','' | replace:'  ',' ' }}
