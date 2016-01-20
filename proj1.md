---
layout: page
---
<ul class="project-links">
  {% for link_hash in page.links %}
    {% for link in link_hash %}
      <li><a class="button" href="{{ link[1] }}">{{ link[0] }}</a></li>
    {% endfor %}
  {% endfor %}
</ul>

