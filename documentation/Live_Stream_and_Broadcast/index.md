---
layout: page
title: Live Stream and Broadcast
---

{% capture html %}
<ul>
    {% assign entries = site.pages | sort: "path" %}
    {% for entry in entries %}
        {% capture slug    %}{{ entry.url | split: "/"   | last                       }}{% endcapture %}
        {% capture current %}{{ entry.url | remove: slug | remove: "//" | append: "/" }}{% endcapture %}
        {% if current contains page.dir %}
	    {% if entry.title %}
		<li><a href="{{entry.url}}">{{ entry.title}} </a></li>
	    {% endif %}
	{% endif %}
    {% endfor %}
</ul>
{% endcapture %} {{ html | strip_newlines | replace:'    ','' | replace:'    ','' | replace:'  ',' ' }}
