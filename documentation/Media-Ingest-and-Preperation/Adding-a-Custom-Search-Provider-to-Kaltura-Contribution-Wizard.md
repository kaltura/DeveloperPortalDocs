---
layout: page
title: Adding a Custom Search Provider to the Kaltura Contribution Wizard (KCW)
---

To learn about the KCW Custom Search Provider see <a href="http://www.kaltura.org/sites/default/themes/kdotorg/demos/kcw-custom-provider/contribution_wizard.php" target="_blank">demo</a> before you begin.

## Background

The <a href="http://knowledge.kaltura.com/kaltura-contribution-wizard-kcw" target="_blank">Kaltura Contribution Wizard</a> is a fully customizable content ingestion wizard, enabling end users to upload and import media from various sources. Kaltura’s ingestion engine allows users to add videos, photos, and audio files in a wide variety of formats. 

The demo explains the workflow of defining a custom content search provider for the KCW Widget.

## Why Define a Custom Search Provider for the KCW?

You may have a repository of content of your own. Creating a custom search provider for the KCW will enable your users to use the KCW Widget as if they were searching through the Kaltura Network.

For example: A university library would like to allow its students to interact with its current media content through the Kaltura tools (player, editor, etc.).  
The IT personnel at the university should create a custom search provider as described in this article, define the new search provider inside the KCW uiConf. The entire content will be reachable for import through the KCW immediately.

## What is a  KCW Search Provider?

The KCW search provider is an xml file containing a list of media elements.

To provide search functionality that allows users to search through the repository content, a search provider should be a server script that is:

*   Accessible by the Kaltura server (either your CE or EE server or the SaaS account that you use)
*   Receive in POST the following set of parameters
*   Returns an XML describing the list of media files

## The Search Provider Script

The search provider script should receive a set of POST parameters and return the results as XML according to format in the following table:

<table cellpadding="6">
  <tbody>
    <tr>
      <th>
        POST Parameter
      </th>
      
      <th>
        Type
      </th>
      
      <th style="text-align: left;">
        Description
      </th>
    </tr>
    
    <tr>
      <td style="text-align: left;">
        uid
      </td>
      
      <td style="text-align: left;" align="center">
        String
      </td>
      
      <td style="text-align: left;">
        The user id of the user using the KCW
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;">
        <span style="text-decoration: line-through;"></span>search
      </td>
      
      <td style="text-align: left;" align="center">
        String
      </td>
      
      <td>
        The keywords the user is searching for (there is not any preprocessing of special characters)
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;">
        media_type
      </td>
      
      <td style="text-align: left;" align="center">
        Integer
      </td>
      
      <td style="text-align: left;">
        1 - video, 2 - image, 5 - audio
      </td>
    </tr>
    
    <tr>
      <td style="text-align: left;">
        page
| POST Parameter | Type    | Description                                                                                   |
|----------------|---------|-----------------------------------------------------------------------------------------------|
| uid            | String  | The user id of the user using the KCW                                                         |
| search         | String  | The keywords the user is searching for (there is not any preprocessing of special characters) |
| media_type     | Integer | 1 - video, 2 - image, 5 - audio                                                               |
| page           | Integer | The page number for paginating the results. First page is 1.                                  |
| page_size      | Integer | The page size (the CW asks for 20 entries by defaults)                                        |
| filter         | Integer | 0 - search all, 1 - Search only my friends (for use by Social Network Sites and a like)       |

## The Search Provider Result XML

The search provider should return an XML formatted list of media content that answers the user's search terms in the following format:

<div>
  {% highlight xml %}<objects> <num_0> <id>xyz123</id><!-- An id that uniquely identify the media --> <url>http://example.com/data/xyz123_media.flv</url><!-- The url to download the media file from --> <tags>dunk,amazing</tags><!-- Comma delimited tags --> <title>amazing dunk</title><!-- The name of the media --> <thumb>http://example.com/thumb/xyz123_thumb.jpg</thumb><!-- Thumbnail url --> <description>amazing jump (30 secs)</description><!-- Displayed description shown in the CW as a tooltip - this will not be stored after import --> <source_link>http://example.com/media_page/xyz123</source_link><!-- OPTIONAL - link to an html page containing the media (for source attribution) --> <credit>john dunker</credit><!-- OPTIONAL - containing attribution information --> <media_source></media_source><!-- OPTIONAL - overrides the request media source --> <flash_playback_type></flash_playback_type><!-- OPTIONAL - for audio files "audio" / "video" --> <license></license><!-- OPTIONAL - enumeration for license type --> </num_0> <num_1> <id>...</id> <url>...</url> <tags>...</tags> <title>...</title> <thumb>...</thumb> <description>...</description> <source_link>...</source_link> <credit>...</credit> <media_source>...</media_source> <flash_playback_type>...</flash_playback_type> <license>...</license> </num_1> ... <num_N> ... </num_N> </objects> {% endhighlight %}
</div>

## The KCW uiConf Setup for Using a Custom Search Provider

To define a tab for the custom search provider inside the KCW, you need to edit the KCW uiConf.

*   Use the <a href="https://developer.kaltura.com/console" target="_blank">API TestMe console</a>
*   Create a session using the session.start action, your partner id, admin secret and select a ADMIN type
*   Use the uiConf.get action to download the uiConf xml of the KCW instance you wish to use

After obtaining the XML of the KCW uiConf you want o use, edit the uiConf xml in your text editor of choice.  
Under the `<mediaTypes>` node, add your custom search provider for every media type separately:

<div>
  {% highlight xml %}<media type="video"> <!-- For every media type; video, audio, image, document, etc. --> <provider id="thissite" name="anywebpage" code="28"> <!-- leave the id and code attributes as is, the name attribute is linked to the locale used --> <moduleUrl>SearchView.swf</moduleUrl> <!-- Always leave as is - this define the actual KCW view to load --> <authMethodList> <authMethod type="1" /> </authMethodList> <tokens> <token> <name>extra_data</name> <value>http://www.kaltura.org/sites/default/themes/kdotorg/demos/kcw-custom-provider/sample-provider.xml</value> </token> </tokens> </provider> </media>{% endhighlight %}
</div>

> Notes:
*   The `<provider>` name attribute defines the text that is displayed on the KCW tab. If you want to change this, add text of your own to the KCW locale, compile a new locale and change the locale attribute in the KCW uiConf.
*   The `<authMethodList>` node lists the available authorization modes used to access the media provider's content repository. With a custom search provider, only the public functionality is available (no authorization available) . We reccommend that you leave this attribute as is.
*   The extra_data token value defines the url of the search provider script to be called. Change this url to the url of your custom search provider script.

## Additional Information

When using a custom provider, the KCW does not call  the custom provider script directly, rather the KCW proxies the call to the custom provider through the Kaltura server it is working on (whether CE/EE or hosted SaaS account).

To learn more, or extend and customize the functionality of the proxy provided by the Kaltura server in self-hosted environments, refer to the the proxy class "mySearchProxyServices" located at:

`/alpha/apps/kaltura/lib/extservices/mySearchProxyServices.class.php`
