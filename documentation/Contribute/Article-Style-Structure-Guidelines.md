---
layout: page
title: Article Style and Structure Guidelines
---

The Kaltura VPaaS Developer Site uses [Jekyll engine](http://jekyllrb.com/) and markdown syntax as the basis of the articles.
To learn about Markdown basics and how to use the format, please read: [GitHub markdown basics](https://help.github.com/articles/markdown-basics).

> **Important note**: Always add new lines before and after every element (heading, table, image, lists, code, embeds, etc).









## Adding Kaltura Videos 
&#123;% onebox http://www.kaltura.com/tiny/nex76 %&#125;

**Will be rendered as:**

{% onebox http://www.kaltura.com/tiny/nex76 %}


## Adding YouTube videos 
&#123;% onebox https://www.youtube.com/watch?v=Owh8nBt4QSs %&#125;

## Adding Syntax Highligted Code

&#123;% highlight c %&#125;
int hello_world(char *world)  
{  
	printf("Hello %s\n", world);  
	return(0);
}  
&#123;% endhighlight %&#125;

**Will render as:**

{% highlight c %}
int hello_world(char *world)
{
	printf("Hello %s\n", world);
	return(0);
}
{% endhighlight %}

## Adding Multi language tabbed divs

Add your code snippet for each lang dir under https://github.com/kaltura/DeveloperPortalDocs/tree/master/code_examples and then include the following in your MD:

&#123;% code_example snippet_file_name %&#125;

**Will render as:**
{% code_example hello_world %}


See [List of supported languages and lexers](https://github.com/jneen/rouge/wiki/list-of-supported-languages-and-lexers).

## Adding Tables

Markdown tables can become messy. Please write clean tables so it will be simple for contributors after you to edit and enahance your work.  
The clean way to add Markdown tables is as follows:

```
  
| HCell        | Header Cell Middle | HCell Align-Right |
|:------------ |:------------------:|------------------:|
| 1 line body  | text               | more txt          |
| 2 line body  | some text          | other txt         |
  
```

Note the use of spaces at the end of cells to ensure a clean alignment in edit view.   
Always specify the alignment indicator (with `:`) to clearly indicate the alignment of the text.   
Be certain to ensure that there is a an empty line above and below each table.   
 
The table above, will be generated as:

| HCell        | Header Cell Middle | HCell Align-Right |
|:------------ |:------------------:|------------------:|
| 1 line body  | text               | more txt          |
| 2 line body  | some text          | other txt         |

You can also use: [TablesGenerator.com](http://www.tablesgenerator.com/markdown_tables).

## Adding Images

Use the standard Markdown notation for images (`![Alt Text](url)`).  
Please always ensure that a descriptive Alt text is specified on your image to ensure compatability with screen readers and better search indexing.  

### Adding an Image Folder

1. Go to the folder inside which you want to create another folder.
2. Add a new file.
3. In the text field for the file name, first write the folder name you want to create and then type / , to create the folder.
4. Commit the new file.


## Adding Diagrams
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

## Note about links to external sites
The VPaaS website will automatically detect if links are using the same domain or a different one.  
Links that are directed to external domains will automatically be appended with `target="_blank"' and will be opened in a new tab.


A nifty tool to help you to see how your markdown looks as you create it: [dillinger.io](http://dillinger.io)

For additional reading on the Markdown flavor in use, see: [Kramdown](http://kramdown.gettalong.org/documentation.html).

## Tips for Creating Great Content

* Start with an introduction by answering the question "what will be learned in this document?".
* Think about the steps that will get your reader from A to Z in the fastest way possible while following Kaltura best-practices.
* Do not add an H1 title (#) to your article. It will be added automatically from the metadata title defined in the ["article header notation"](#header-notation) section.
* All sections should be separated by H2 headings (##), subsections by H3 headings (###) and so on.
* **Don't forget to spell check!**

### Remember that your audience is developer-focused, therefore:

Think about steps that will take your reader through actual scenarios' breakdown, with code reference examples that are complete and easy to follow.

* Include code snippets where relevant.
* Create Interactive Code Workflows where possible (https://developer.kaltura.com/workflows).
* Reference API end-points where applicable, and make sure to explain these API end-points and their respective request and response fields and formats. 
* Reference relevant github repositories where applicable.
* Clearly explain the required workflows, and ensure they achieve a final and complete end-result.
* When in doubt, assume that your reader will be a newbie and doesn't know much about the context, so link to relevant reading material and explain information properly.


## How to Contribute and Help Improve the Documentation

* Every topic category (e.g. Content Ingestion & Acquisition) has a respective directory under this repository.
* All markdown documents should be saved in this repository under the respective topic category directory.
* When naming your files, please use the same convention as the other documents on this repository:
 * Lower case
 * Spaces converted to dash
 * Filename always ends with `.md` as the file extension
 * The filename should always reflect the title of the article (i.e. H1 == filename)
* Follow the guidelines for article header notation as per below


## <a name="header-notation"></a>Article Header Notation
At the top of every markdown file, you will find the notation as follows. This designates the type of page and its location in the website menu.


{% highlight markdown %}
---
layout: page
title: VPaaS Website Sample Article
---

{% endhighlight %}


### The document metadata fields are:  

* `layout:` for documents, this should always be set to `page`
* `title:` this is the title of the page (correlates to `<title></title>` tag in HTML)
