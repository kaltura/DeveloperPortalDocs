---
layout: page
title: Article Style and Structure Guidelines
---

The Kaltura VPaaS Developer Site is using [Jekyll engine](http://jekyllrb.com/) and markdown syntax as the basis of the articles.
To learn about Markdown basics and how to use the format, please read: [GitHub markdown basics](https://help.github.com/articles/markdown-basics/).


## Adding Kaltura videos 
&#123;% onebox http://www.kaltura.com/tiny/nex76 %&#125;

**Will be rendered as:**

{% onebox http://www.kaltura.com/tiny/nex76 %}

## Adding YouTube videos 
&#123;% onebox https://www.youtube.com/watch?v=Owh8nBt4QSs %&#125;

## Adding syntax highligted code

&#123;% highlight c %&#125;
int hello_world(char *world)  
{  
    printf("Hello %s\n", world);  
}  
&#123;% endhighlight %&#125;

**Will render as:**

{% highlight c %}
int hello_world(char *world)
{
    printf("Hello %s\n", world);
}
{% endhighlight %}

See [List of supported languages and lexers](https://github.com/jneen/rouge/wiki/list-of-supported-languages-and-lexers)


## Adding diagrams
&#123;% plantuml %&#125;

participant App
participant "Kaltura Player" as KP

App->KP: setCustomURLProvider(localURLProvider)
App->KP: setConfig(entryConfig)
App->KP: play()
KP->localURLProvider: getURL(entryId)
localURLProvider-->KP: localPath

note over KP: Plays the downloaded file

&#123;% endplantuml %&#125;

**Will render as:**
{% plantuml %}
participant App
participant "Kaltura Player" as KP

App->KP: setCustomURLProvider(localURLProvider)
App->KP: setConfig(entryConfig)
App->KP: play()
KP->localURLProvider: getURL(entryId)
localURLProvider-->KP: localPath

note over KP: Plays the downloaded file

{% endplantuml %}

## Adding links to external sites
&#123;% extlink Debian GNU Linux http://debian.org %&#125;

**Will render as:**
{% extlink Debian GNU Linux http://debian.org %}

A nifty tool to help you to see how your markdown looks as you create it: [dillinger.io](http://dillinger.io/)

For additional reading on the Markdown flavor we use read: [Kramdown](http://kramdown.gettalong.org/documentation.html).

## Tips for Creating Great Content

* Start with an introduction by answering the question “what will be learned in this document?”.
* Think about the steps that will get your reader from A to Z in the fastest way possible while following Kaltura best-practises.
* Do not add an H1 title (#) to your article, it will be added automatically from the metadata title defined in the ["article header notation"](#header-notation) section
* All sections should be separated by H2 headings (##), subsections by H3 headings (###) and so on.
* **Don't forget to spell check!**

### Remember that your audience is developer-focused, therefore:

Think about steps that will take your reader through actual scenarios breakdown with code reference examples that are complete and easy to follow.

* Include code snippets where relevant
* Create code recipes where possible (developer.kaltura.org)
* Reference API end-points where applicable, and make sure to explain these API end-points and their respective request and response fields and formats 
* Reference relevant github repositories where applicable
* Clearly explain the required workflows, and ensure they achieve a final and complete end-result
* When in doubt, assume that your reader will be a newbie and doesn't know much about the context, so link to relevant reading material and explain things properly


## How to contribute and help improve the documentation

* Every topic category (e.g. Content Ingestion & Acquisition) has a respective directory under this repository.
* All markdown documents should be saved in this repository under the respective topic category directory.
* When naming your files, please use the same convention as the other documents on this repository:
 * Lower case
 * Spaces converted to dash
 * Filename always ends with `.md` as the file extension
 * The filename should always reflect the title of the article (i.e. H1 == filename)
* Follow the guidelines for article header notation as per below


## <a name="header-notation"></a>Article header notation
At the top of every markdown file, you will find the below notation. This designates the type of page and its location in the website menu.


{% highlight markdown %}
---
layout: page
title: VPaaS Website Sample Article
---

{% endhighlight %}


### The document metadata fields are:  

* `layout:` for documents, this should always be set to `page`
* `title:` this is the title of the page (correlates to `<title></title>` tag in HTML)
