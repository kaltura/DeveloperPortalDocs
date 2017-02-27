---
layout: page
title: "JavaScript API for Kaltura Media Players"
date: 2011-12-20 09:35:46
---

<h1 class="mce-heading-1">
  Understanding the JavaScript API for Kaltura Media Players
</h1>

<p class="Sub-Heading">
  <strong>What is the Kaltura Media Player JavaScript API and why use it?</strong>
</p>

Kaltura’s flexible media players – the [Kaltura HTML5 player][1] and the Flash-based [Kaltura Dynamic Player version 3 (KDP3)][2] – provide media online publishing solutions that are easy to use and embed. Kaltura enables you to reach the widest possible end-user audience by using HTML5 in conjunction with KDP3. To learn more about how to embed Kaltura players in your web site and support cross-platform media playback, refer to [Embedding Kaltura Media Players in Your Site][3].

 [1]: http://html5video.org/wiki/Getting_Started_with_Kaltura_HTML5
 [2]: http://www.kaltura.org/project/Video_Player_Playlist_Widget
 [3]: http://knowledge.kaltura.com/embedding-kaltura-media-players-your-site

Embedding a Kaltura player is the first step in ensuring a rich user experience. Kaltura's powerful media player JavaScript API enables you to design flexible, multifaceted interaction with the player.

The JavaScript API is a two-way communication channel that lets the player tell you what it is doing and lets you tell the player to do things.

You can use the JavaScript API to:

*   Enable your web page to interact seamlessly with the player
*   Create user interactions with the player
*   Customize aspects of the player

<p class="Sub-Heading">
  <strong>The Basics of the Base Methods</strong>
</p>

Using the JavaScript API's powerful base methods, you can:

*   Tell the player to initiate an action or react to something a user does. For example, when a user selects a thumbnail in a media gallery, tell the player to play the selection. See [Invoking player actions (sendNotification)][4].
*   Find out something about the player. For example, get information about the current video to show to the user. See [Retrieving information in runtime (evaluate)][5].
*   Change something about the player without reloading the web page. For example, make the player begin playing automatically without the user clicking a Play button. See [Changing player attributes in runtime (setKDPAttribute)][6].

 [4]: #sendNotification
 [5]: #evaluate
 [6]: #setKDPAttribute

<p class="Sub-Heading">
  <strong>Advanced Uses</strong>
</p>

There are more advanced things that you can do with the JavaScript API.

*   If you want multiple players on the same web page, you need to configure the [jsCallbackReady][7] JavaScript API function. See [Managing Multiple Players on the Same Page][8].
*   You may enrich the user experience and help monetize your site with calls to action and by displaying supplementary material or advertisements at specific points in the video. To support these features, you need to handle the relevant player JavaScript events. See [Handling Player JavaScript Events][9].

 [7]: http://www.kaltura.org/demos/kdp3/docs.html#jscallbackready
 [8]: #ManagingMultiplePlayersontheSamePage
 [9]: #HandlingPlayerJavaScriptEvents

<p class="Sub-Heading">
  <strong>In this document you will learn about:</strong>
</p>

*   [The JavaScript API Workflow][10], which includes:
    *   [Enabling the JavaScript API][11]
    *   [Receiving Notification that the Player API Is Ready (jsCallbackReady)][12]
    *   [Using the JavaScript API's Base Methods][13]:
        *   [Understanding Events, Notifications, and Commands][14]
        *   [Listening and responding to player events (addJsListener/removeJsListener)][15]
        *   [Invoking player actions (sendNotification)][4]
        *   [Retrieving information in runtime (evaluate)][5]
        *   [Changing player attributes in runtime (setKDPAttribute)][6]

*   [Understanding JavaScript API Support Differences for Flash and HTML5 Players][16]

*   [Managing Multiple Players on the Same Page][8]

*   [Handling Player JavaScript Events][9]:

*   [Creating Calls to Action Using Custom Buttons][17]

*   [Handling Player Cue Points Using JavaScript][18]

*   [Best Practices][19] for coding

 [10]: #UnderstandingtheJavaScriptAPIWorkflow
 [11]: #EnablingtheJavascriptAPI
 [12]: #NotificationPlayerAPIIsReady
 [13]: #UsingtheJavaScriptAPsBaseMethods
 [14]: #UnderstandingEventsNotificationsCommands
 [15]: #addJsListenerremoveJsListener
 [16]: #UnderstandingJSAPIDiffs4FlashHTML5
 [17]: #CreatingCallstoActionCustomButtons
 [18]: #HandlingCodeandAdCuePointsUsingJS
 [19]: #BestPractices

<h1 class="mce-heading-1">
  <a name="UnderstandingtheJavaScriptAPIWorkflow"></a>Understanding the JavaScript API Workflow
</h1>

<p class="Sub-Heading">
  <strong>Questions Answered</strong>
</p>

How do you work with the JavaScript API?

<p class="Sub-Heading">
  <strong>JavaScript API Workflow</strong>
</p>

The workflow for the Kaltura media player JavaScript API is:

1.  [Enable the JavaScript API][11].
2.  [Receive notification that the player API is ready (jsCallbackReady)][12].
3.  [Use the JavaScript API's base methods][13].

For API documentation, refer to [Kaltura Dynamic Player version 3, JavaScript APIs][20].

 [20]: http://www.kaltura.org/demos/kdp3/docs.html#jsapi

<h1 class="mce-heading-1">
  <a name="EnablingtheJavascriptAPI"></a>Enabling the JavaScript API
</h1>

<p class="Sub-Heading">
  <strong>Questions Answered</strong>
</p>

How do you enable the JavaScript API to work with the player?

<p class="Sub-Heading">
  <strong>Enabling the externalInterfaceDisabled Parameter</strong>
</p>

For a Kaltura player to communicate with the JavaScript API, you enable the Flash's external interface *externalInterfaceDisabled* parameter. By default, the parameter is disabled.

<p class="Sub-Heading mce-procedure">
  To enable the externalInterfaceDisabled parameter:
</p>

Include the following flashVar in the player embed code: *externalInterfaceDisabled=false*

# <a name="NotificationPlayerAPIIsReady"></a>Receiving Notification that the Player API Is Ready (jsCallbackReady)

<p class="Sub-Heading">
  <strong>Questions Answered</strong>
</p>

How do you know that the player is ready to work with the JavaScript API?

<p class="Sub-Heading">
  <strong>Notification of Player Readiness</strong>
</p>

Before you can [use the JavaScript API's base methods][13], the player has to reach the point in its internal loading sequence when it is ready to interact with your code. The player lets you know that it is ready by calling the [jsCallbackReady][7] JavaScript function on the page.

*jsCallbackReady* is the player's first callback.

The player passes *jsCallbackReady* an *objectId* parameter that represents the identifier of the player that is embedded on the page:{% highlight javascript %}function jsCallbackReady(objectId) { window.kdp = document.getElementById(objectId); } {% endhighlight %}

Kaltura recommends that you place *jsCallbackReady* in the global scope. This allows easily finding this critical function in the JavaScript code.

<h1 class="mce-heading-1">
  <a name="UsingtheJavaScriptAPsBaseMethods"></a>Using the JavaScript API's Base Methods
</h1>

<p class="Sub-Heading">
  <strong>Questions Answered</strong>
</p>

How do you use the JavaScript API?

<p class="Sub-Heading">
  <strong>Accessing the JavaScript API Base Methods</strong>
</p>

You can access the entire JavaScript API through methods that enable:

*   [Listening and responding to player events (addJsListener/removeJsListener)][15]:  
    React to internal player events, such as beginning play and pausing.
*   [Invoking player actions (sendNotification)][4]:  
    Tell the player to do something, such as play or pause.
*   [Retrieving information in runtime (evaluate)][5]:  
    Find out something about a player, such as the media that is loaded in the player and flashVars that the player passes.
*   [Changing player attributes in runtime (setKDPAttribute)][6]:  
    Modify player attributes, such as a label on a player UI.

<h2 class="mce-heading-2">
  <a name="UnderstandingEventsNotificationsCommands"></a>Understanding Events, Notifications, and Commands
</h2>

KDP3 is based on the PureMVC framework. Significant occurrences in KDP3 are passed as *notifications*. KDP3 externalizes Flash notifications to be available for JavaScript.

KDP3 fires notifications of passive events. A JavaScript listener ([JsListener][15]) detects KDP3 JavaScript notifications. This lets you detect specific events and react to them.

Notifications also are active events that you can use with the [sendNotification][21] method to command the player to do something.

 [21]: http://www.kaltura.org/demos/kdp3/docs.html#sendnotification

Refer to [KDP Events][22] for descriptions of passive and active events.

 [22]: http://www.kaltura.org/kalorg/kdp/trunk/kdp3Lib/docs/notifications%20-%20KDP%20events.txt

<h2 class="mce-heading-2">
  <a name="addJsListenerremoveJsListener"></a>Listening and Responding to Player Events (addJsListener/removeJsListener)
</h2>

<p class="Note mce-note-graphic">
  In KDP versions 3.4.10.1 and earlier, JsListeners are executed first and precede the player’s actions. In KDP versions 3.4.10.2 and later, player actions (such as calling the core and plugin handlers) always precede calling the JsListeners.
</p>

<h3 class="mce-heading-3">
  <a name="UsingaddJsListener"></a>Using addJsListener
</h3>

Use the [addJsListener][23] method to listen for a specific notification that something happened in the player, such as the video is playing or is paused.

 [23]: http://www.kaltura.org/demos/kdp3/docs.html#addlistener

<p class="Sub-Heading">
  <strong>addJsListener Method Syntax</strong>
</p>{% highlight javascript %}addJsListener("event", "functionName"){% endhighlight %}

*   *event* is a string that represents the name of the event notification. Enclose the notification name in single or double quotation marks.
*   *functionName* is a string that represents the name of the listener function to call when the event occurs. Enclose the listener function name in single or double quotation marks, without parentheses.

<p class="Sub-Heading">
  <strong><a name="addJsListenerSampleCode"></a>Sample Code</strong>
</p>

You may want to enrich the user experience by displaying a video's elapsed time as it plays. Implementing this option requires listening for the video entry's updated time.

To listen for a player entry time being updated:

1.  Pass *playerUpdatePlayhead* on the notification name parameter in *addJsListener*.
2.  On your web page, define a JavaScript function that is called when the *playerUpdatePlayhead* notification is fired in the player (for example, *playerUpdatePlayheadHandler*).
3.  Pass the JavaScript function name as the listener *functionName* parameter in *addJsListener*.{% highlight javascript %}kdp.addJsListener(“playerUpdatePlayhead”, “playerUpdatePlayheadHandler”) function playerUpdatePlayheadHandler(data, id) { // data = the player's progress time in seconds // id = the ID of the player that fired the notification }{% endhighlight %}

<h3 class="mce-heading-3">
  Using removeJsListener
</h3>

Use the [removeJsListener][24] method to remove a listener that is no longer needed.

 [24]: http://www.kaltura.org/demos/kdp3/docs.html#removelistener

<p class="Sub-Heading">
  <strong>Why Remove a JsListener?</strong>
</p>

KDP3 accumulates JsListeners. If you add a JsListener for a notification and then add another JsListener for the same notification, the new JsListener does not override the previous one. Both JsListeners are executed in the order in which they are added. To prevent unexpected behavior in your application, Kaltura recommends that you remove unnecessary JsListeners.

When you remove a listener, you must specify the associated function name.

<p class="Sub-Heading">
  <strong>removeJsListener Method Syntax</strong>
</p>{% highlight javascript %}removeJsListener("event", "functionName"){% endhighlight %}

*   *event* is a string that represents the name of the event notification. Enclose the notification name in single or double quotation marks.
*   *functionName* is a string that represents the name of the listener function called when the event occurs. Enclose the listener function name in single or double quotation marks, without parentheses.

<p class="Sub-Heading">
  <strong>Sample Code</strong>
</p>

To limit listening to a player update event to a single instance:

1.  Insert the *addJsListener* method to listen for a player update event. For details, see [addJsListener sample code][25].
2.  Insert the *removeJsListener* method:

 [25]: #addJsListenerSampleCode

> *   Pass "*playerUpdatePlayhead*" on the notification name parameter.
> *   Pass the JavaScript function name on the listener *functionName* parameter.{% highlight javascript %}kdp.addJsListener(“playerUpdatePlayhead”, “playerUpdatePlayheadHandler”) function playerUpdatePlayheadHandler(data, id) { // data = the player's progress time in seconds // id = the ID of the player that fired the notification; } kdp.removeJsListener(“playerUpdatePlayhead”, “playerUpdatePlayheadHandler”){% endhighlight %}

<h2 class="mce-heading-2">
  <a name="sendNotification"></a>Invoking Player Actions (sendNotification)
</h2>

Use the [sendNotification][21] method to create custom notifications that tell the player to do something, such as play, seek, or pause.

<p class="Sub-Heading">
  <strong>sendNotification Method Syntax</strong>
</p>{% highlight javascript %}sendNotification("command", { optional : data }){% endhighlight %}

*   *command* is a string that represents the player command. Enclose the command in single or double quotation marks.
*   *{ optional : data }* is an optional  JavaScript Object Notation (JSON) object.

<p class="Sub-Heading">
  <strong>Sample Code</strong>
</p>

To play a video from a specific point, call the *jumpToTime* function in the script area of your web page:

1.  Pass the *doPlay* command on the *command* parameter in *sendNotification*.  
    Note: *doPlay* does not require a parameter. You can either use null or omit it.
2.  Pass the *doSeek* command on the *command* parameter in *sendNotification*.   
    Specify a *timesec* parameter in milliseconds from the beginning of the video.{% highlight javascript %}<script language="JavaScript"> var kdp; function jumpToTime(timesec) { kdp.sendNotification("doPlay"); // kdp.sendNotification('doPlay', null); // Null parameters are optional // Moves to a specific point, defined in seconds from the start of the video kdp.sendNotification("doSeek", timesec); } </script>{% endhighlight %}

<h2 class="mce-heading-2">
  <a name="evaluate"></a>Retrieving Information in Runtime (evaluate)
</h2>

<p class="Sub-Heading">
  <strong>Understanding the evaluate Method</strong>
</p>

Use the [evaluate][26] method to find out something about a player by extracting data from player components.

 [26]: http://www.kaltura.org/demos/kdp3/docs.html#evaluate

The *evaluate* method is valid for any object that KDP3 externalizes for JavaScript, including:

*   uiConf components
    *   Buttons and labels are examples of uiConf components.  
        Note: Use the component ID to access a uiConf component.

*   Modifiable KDP3 data, such as flashvars and media information
    *   Media information is managed as proxy data, known as Value Objects (VO). Refer to <a href="http://knowledge.kaltura.com/faq/how-create-kdp-plugins#proxies" target="_blank">KDP-Data-Proxies</a>.

*   The Kaltura Entry Object

*   The Kaltura Entry Object stores all of the textual data related to an entry.

<p class="Sub-Heading">
  <strong>evaluate Method Syntax</strong>
</p>{% highlight plaintext %}evaluate("{object.property.property}"){% endhighlight %}

*   *object.property.property*is the reference to the component object with data that you want to extract. Enclose the reference in curly braces within single or double quotation marks.
    *   *property* references are optional sub-objects and/or properties. *property* can be an object.

<p class="Sub-Heading">
  <strong>Sample Code</strong>
</p>

To get the name of an entry from a player so that you can display it:

1.  On your web page, define a function to get the entry name, for example, *getName*.
2.  Pass the component object reference on the *object.property.property* parameter in *evaluate*. Specify the object and property (*entry* and *name*) to extract.
3.  Define an alert that displays the extracted data.{% highlight plaintext %}function getName() { var entry\_name = kdp.evaluate('{mediaProxy.entry.name}'); alert('Entry name: '+entry\_name); }{% endhighlight %}

<h2 class="mce-heading-2">
  <a name="setKDPAttribute"></a>Changing Player Attributes in Runtime (setKDPAttribute)
</h2>

Use the *setKDPAttribute* method to change something about a player by setting player attribute values.

<p class="Note mce-note-graphic">
  For KDP versions 3.2 and later, use setKDPAttribute. For earlier KDP versions, use <a href="http://www.kaltura.org/demos/kdp3/docs.html#setattribute">setAttribute</a>.
</p>

<p class="Sub-Heading">
  <strong>setKDPAttribute Method Syntax</strong>
</p>{% highlight javascript %}setKDPAttribute("object","property","value"){% endhighlight %}

*   *object* is a string that represents the object you want to modify. Use standard dot notation to specify sub-objects, for example, *configProxy.flashvars*.
*   *property* is the player property that you want to modify.
*   *value* is the new value that you want to set for the player property.
*   Enclose each parameter – *object*, *property*, and *value* – in single or double quotation marks.  
    Note: Do not enclose the parameters in curly braces . (Compare to [Retrieving Information in Runtime (evaluate)][5]).

<p class="Sub-Heading">
  <strong>Sample Code</strong>
</p>

To make a player begin playing automatically, pass the following parameters in *setKDPAttribute*:

1.  Pass *configProxy.flashvars* on the *object* parameter. Define this object using standard dot notation. *configProxy* holds parameters related to general player configuration.
2.  Pass *autoPlay* on the *property* parameter.
3.  Pass *true* on the *value* parameter.{% highlight javascript %}kdp.setKDPAttribute("configProxy.flashvars","autoPlay","true"){% endhighlight %}

<h1 class="mce-heading-1">
  <a name="UnderstandingJSAPIDiffs4FlashHTML5"></a>Understanding JavaScript API Support Differences for Flash and HTML5 Players
</h1>

<p class="Sub-Heading">
  <strong>Questions Answered</strong>
</p>

How is JavaScript API support different for Flash-based KDP3 and HTML5 players?

**JavaScript API Support Differences**

For the APIs (Event Listener and Send Notification) that KDP3 and HTML5 players support, refer to [Kaltura KDP API Compatibility][27].

 [27]: http://html5video.org/wiki/Kaltura_KDP_API_Compatibility

<h1 class="mce-heading-1">
  <a name="ManagingMultiplePlayersontheSamePage"></a>Managing Multiple Players on the Same Page
</h1>

<p class="Sub-Heading">
  <strong>Questions Answered</strong>
</p>

What do you need to do with the JavaScript API to manage multiple players on the same web page?

<p class="Sub-Heading">
  <strong>JavaScript API Considerations in Managing Multiple Players</strong>
</p>

<p class="Note mce-note-graphic">
  Kaltura does not recommend using multiple players on the same page. The best practice is to use a single player and display additional videos as thumbnails. When a user selects a thumbnail, the selection loads and plays in the single player.
</p>

You can manage multiple players on the same page using either of the following options:

<p class="Note mce-note-graphic">
  Assign a unique object identifier to each player.
</p>

*   In the [jsCallbackReady][7] JavaScript API function, add a conditional *if* statement for each player identifier.
*   For each player, use unique *jsCallbackReadyFunc* flashVars to call a different *jsCallbackReady* function for each player. *jsCallbackReadyFunc* specifies the name of the JavaScript function to call when the player informs the JavaScript interface that it is loaded and ready for interaction.

> 1.  Define a *jsCallbackReady* function for each player object identifier.
> 2.  Pass flashVars in the format *jsCallbackReadyFunc = {jsCallbackReadyFuncName}* for each player.

*   Replace *{jsCallbackReadyFuncName}*, including the curly braces, with each unique *jsCallbackReady* function name.  
    Note: Kaltura recommends that you use *jsCallbackReady* as part of each function name.  

For more information on *jsCallbackReady*, see [Receive notification that the player API is ready (jsCallbackReady)][12].

<h1 class="mce-heading-1">
  <a name="HandlingPlayerJavaScriptEvents"></a>Handling Player JavaScript Events
</h1>

<p class="Sub-Heading">
  <strong>Questions Answered</strong>
</p>

*   What are the benefits of using call to action buttons and cue points that trigger actions?
*   How do you set up custom call to action buttons and implement the actions associated with the buttons?
*   How do you implement actions triggered by cue points?

<p class="Sub-Heading">
  <strong>Understanding Actions Added to the Player</strong>
</p>

You can use the Kaltura player to enrich the user experience and help monetize your site. Examples include:

*   Customizing call to action buttons
*   Displaying supplementary material or advertisements at specific points in the video

To learn about the benefits and how to support the player JavaScript events that enable these features, see:

*   [Creating Calls to Action Using Custom Buttons][17]
*   [Handling Player Cue Points Using JavaScript][18]

<h2 class="mce-heading-2">
  <a name="CreatingCallstoActionCustomButtons"></a>Creating Calls to Action Using Custom Buttons
</h2>

<p class="Sub-Heading">
  <strong>Understanding Calls to Action and Their Benefits</strong>
</p>

A call to action is a web page element that prompts the user to do something, usually by clicking a button.

Calls to action can help you:

*   Increase engagement in your site
*   Improve your site's conversion rate
*   Promote user interaction
*   Encourage users to return to your site – even when your player is embedded on a different site

<p class="Sub-Heading">
  <strong>Understanding How to Create Call to Action Custom Buttons</strong>
</p>

You customize call to action buttons for Kaltura players by:

1.  [Designing a call to action button][28] in the Kaltura Management Console (KMC)
2.  [Defining what happens when a user clicks a call to action button][29] by writing a JavaScript command that you assign to the button

 [28]: #DesigningaCallToActionButton
 [29]: #Definingcalltoactionbutton

You can add up to five custom buttons.

Each button calls a JavaScript function that you define.

For each button, you can decide where and when the button is displayed, and define a label and tooltip.

The icon for a custom button is a star. You cannot modify the icon.

<h3 class="mce-heading-3">
  <a name="DesigningaCallToActionButton"></a>Designing a Call To Action Button
</h3>

<p class="Note mce-note-graphic">
  To learn more about how to configure the player features, refer to the KMC User Manual.
</p>

<p class="Sub-Heading mce-procedure">
  To design a call to action button:
</p>

1.  Open the KMC and go to [Studio][30].
2.  Edit an existing player or select a new player.  
    <img src="../../assets/70.img">
3.  In the Edit Player or Create New Player window, go to the Features tab and open the Custom Buttons menu.  
    <img src="../../assets/71.img">
4.  Select one or more custom buttons and click **Options** to design the button. You can display your changes in the Preview pane.  
    <img src="../../assets/72.img">
5.  Under Options, you can modify the following:  
    <img src="../../assets/73.img">
*   Location and Playing States
    *   Display the button in the main video area, in the video controls area at the bottom of the player, or both.
    *   Define when during the play cycle to display the button in the main video area.
    *   Define whether to display the button's icon or label in the video controls area.
*   Label – Define a textual label for the button.
*   Tooltip – Define a tooltip that is displayed when the user hovers over the button in the main video area or the video controls area.

6.  Click **Apply** to review your modifications, and then click **Save Changes**.

 [30]: http://www.kaltura.com/index.php/kmc/kmc4#studio%7CplayersList

For example, you can design a player with a Rent Video button.

<img src="../../assets/74.img">

Continue with [defining what happens when a user clicks the button][29].

<h3 class="mce-heading-3">
  <a name="Definingcalltoactionbutton"></a>Defining What Happens When a User Clicks a Call to Action Button
</h3>

<p class="Sub-Heading mce-procedure">
  To define the action that a user triggers when clicking a custom button:
</p>

In the script area of the web page where you embed the player with the custom button:

1.  Insert the following JavaScript function.  
    {% highlight javascript %}<script> function customFuncx (entryId){ // Add your custom code here. } </script>{% endhighlight %}
2.   Replace *x* in *customFunc**x*** with the custom button digit. For example, use *customFunc1* for Custom Button 1. See [Designing a Call To Action Button][28].
3.  Where indicated, add JavaScript code that defines an action. For example, create an alert that Custom Button 1 was clicked:{% highlight javascript %}function customFunc1(entryId) { alert('Custom button was clicked. Played entryId is '+ entryId ); }{% endhighlight %}

To learn more, refer to [Integrate KDP on web pages (JavaScript)][31].

 [31]: http://www.kaltura.org/integrate-kdp-web-pages-javascript

<h2 class="mce-heading-2">
  <a name="HandlingCodeandAdCuePointsUsingJS"></a>Handling Player Cue Points Using JavaScript
</h2>

<p class="Sub-Heading">
  <strong>Understanding Cue Points and Their Benefits</strong>
</p>

A cue point is a marker at a precise point of time in a video or audio entry. You may assign metadata to a cue point using the [Kaltura API][32].

 [32]: http://www.kaltura.org/kaltura-api-and-testme-console-introduction

You use a cue point to trigger a time-based event. You can use [code cue points][33] and ad cue points.

 [33]: #HandlingCodeCuePoints

You use code cue points to display a file – such as a document, image, or comment – that relates to the content. Code cue points can help you:

*   Enrich the user experience
*   Coordinate related material with specific media content
*   Enable users to skip to specific chapters
*   Share user-generated content at precise points of the playback

You use ad cue points to insert advertisements at a specified point in the video.

<p class="Note">
  <span class="mce-note-graphic">To learn how to insert advertisements, refer to the KMC User Manual.</span>
</p>

Ad cue points can help you:

*   Generate revenue using midroll advertisements
*   Time ads for specific intervals
*   Coordinate ads with the media content

In a single video, you may define different types of cue point events and include multiple cue points of each type.

In the [Kaltura Demo Apps][34], try out the Code Cue Points Demo by selecting the demo from the drop-down menu at the top of the page. The demo lets you create code cue points in a Kaltura video entry and display related files that you tailor for each code cue point.

 [34]: http://demo.kaltura.com/showcase/

<h3 class="mce-heading-3">
  <a name="HandlingCodeCuePoints"></a>Handling Code Cue Points
</h3>

<p class="Note mce-note-graphic">
  To learn about adding and editing cue points in a video, refer to the KMC User Manual.
</p>

<p class="Sub-Heading">
  <strong>Understanding a Code Cue Point Use Case</strong>
</p>

The [sample code][35] illustrates how to handle code cue points for this use case:

 [35]: #CodeCuePointSampleCode

<img src="../../assets/68.img">

*   A cue point is defined for each chapter.
*   As the video plays and reaches each cue point, the associated chapter name is displayed automatically.
*   When the user selects a chapter name, the player starts playing the video at the selected cue point. 

<p class="Sub-Heading">
  <strong><a name="CodeCuePointSampleCode"></a>Sample Code</strong>
</p>

In the script area of the web page where you embed the player, add a JavaScript script:

1.  Insert the [addJsListener][23] method (see [Using addJsListener][36]) to detect a cue point.  
    {% highlight javascript %}myPlayer.addJsListener("cuePointReached", "cuePointHandler");{% endhighlight %}
*   Pass *"cuePointReached"* on the notification name parameter.
*   Pass a function that you define to handle cue points on the listener *functionName* parameter.

2.  Insert your function that handles cue points. Enable the function to receive a cue point identifier.  
    {% highlight javascript %}var currentCue = null; var cuePointHandler = function( qPoint ) { switchActiveCue('cp'+qPoint.cuePoint.id); };{% endhighlight %}
3.  Insert a function that you define (for example, *switchActiveCue*) to make a selected cue point active.  
    {% highlight javascript %}var switchActiveCue = function ( newId ) { if (currentCue != null) currentCue.className = ''; currentCue = document.getElementById(newId); currentCue.className = 'selected'; console.log(newId); }{% endhighlight %}
4.  Insert a function  that you define (for example, *jumpToTime*) to go to a point in the video (defined in milliseconds from the start of the video) and begin playing.   
    {% highlight javascript %}var jumpToTime = function ( timesec ) { if (myPlayer != null) { myPlayer.sendNotification("doPlay"); myPlayer.sendNotification("doSeek", timesec/1000); } }{% endhighlight %}Use the [sendNotification][21] method (see [Invoking player actions (sendNotification)][4]).
*   Pass the *doPlay* command on the *command* parameter in *sendNotification*.
*   Pass the *doSeek* command on the *command* parameter in *sendNotification*.  

 [36]: #UsingaddJsListener

<p class="Note">
  <span class="mce-note-graphic">This sample requires additional code.</span>
</p>

<p class="Note">
  Populate cue points dynamically in an unordered list. <br /> For each cue point, define a click event and:
</p>

*   Assign the function that starts the video from the cue point (*jumpToTime*) to the click event.
*   Assign the function that selects the cue point (*switchActiveCue*) to the click event.
*   Display the cue point time and description.

<p class="Sub-Heading">
  <strong>Code Cue Point Sample Code</strong>
</p>{% highlight javascript %}<script> var jsCallbackReady = function( playerId ) { myPlayer = document.getElementById(playerId); myPlayer.addJsListener("cuePointReached", "cuePointHandler"); }; var currentCue = null; var cuePointHandler = function( qPoint ) { switchActiveCue('cp'+qPoint.cuePoint.id); }; var switchActiveCue = function ( newId ) { if (currentCue != null) currentCue.className = ''; currentCue = document.getElementById(newId); currentCue.className = 'selected'; console.log(newId); } var jumpToTime = function ( timesec ) { if (myPlayer != null) { myPlayer.sendNotification("doPlay"); myPlayer.sendNotification("doSeek", timesec/1000); } } </script>{% endhighlight %}

<h1 class="mce-heading-1">
  <a name="BestPractices"></a>Best Practices
</h1>

<p class="Sub-Heading">
  <strong>Questions Answered</strong>
</p>

What best practices does Kaltura recommend for working with the JavaScript API?

<span class="mce-heading-2">Caching the Player Object in a Global Variable</span>

Cache a reference to the player object inside a global variable using the following syntax:{% highlight javascript %}window.kdp = document.getElementById(player_id);{% endhighlight %}

When you place a reference to the player object inside a variable, you do not need to query the document object model (DOM) each time you do something with the player, such as adding or removing event listeners.

Kaltura recommends prefixing *window.* to the variable name to indicate that a global variable is being created.

<h1 class="mce-heading-1">
  Glossary
</h1>

<table border="1" cellspacing="0" cellpadding="0">
  <thead>
    <tr>
      <td valign="top" width="198">
        <p class="TableHeading">
          Term
        </p>
      </td>
      
      <td valign="top" width="425">
        <p class="TableHeading">
          Definition
        </p>
      </td>
    </tr>
  </thead>
  
  <tbody>
    <tr align="left">
      <td valign="top" width="198">
        <p class="TableText" style="text-align: left;">
          Entry
        </p>
      </td>
      
      <td valign="top" width="425">
        <p class="TableText" style="text-align: left;">
          Kaltura's database and API representation of a content entity and its metadata.
        </p>
        
        <p class="TableText" style="text-align: left;">
          Entry types include media, video, audio, image, data, mix, document, and playlist.
        </p>
        
        <p class="TableText" style="text-align: left;">
          Entry metadata includes type, storage location, title, tag, and rating.
        </p>
      </td>
    </tr>
    
    <tr>
      <td valign="top" width="198">
        <p class="TableText" style="text-align: left;">
          KMC
        </p>
      </td>
      
      <td style="text-align: left;" valign="top" width="425">
        <p class="TableText">
          Kaltura Management Console. An application for content management, application creation and configuration, content monetization, distribution and syndication, and account management and reporting. The KMC is accessed by Kaltura partner administrators and the various users of a Kaltura account.
        </p>
      </td>
    </tr>
  </tbody>
</table>

 
