---
layout: page
title: Kaltura iOS player API Base Methods
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios)

# Kaltura iOS player API Base Methods

You can access the entire player API through methods that enable:

* Listening and responding to player events (addJsListener/removeJsListener):
React to internal player events, such as beginning play and pausing.

```objective_c

/*!
 * @function addEventListener:eventID:handler:
 *
 * @abstract
 * Registers to one of the players events
 *
 * @param NSString name of One of the players events
 * @param NSString event id, will enable to remove the current event by id
 * @param handler Callback for the ready event.
 */
- (void)addKPlayerEventListener:(NSString *)event eventID:(NSString *)eventID handler:(void(^)(NSString *eventName, NSString *params))handler;

/*!
 * @function removeEventListener:eventID
 *
 * @abstract
 * Removes One of the players events by id
 *
 * @param NSString event, name of One of the players events.
 * @param NSString eventID, event id for removal.
 * @param handler Callback for the ready event.
 */
- (void)removeKPlayerEventListener:(NSString *)event eventID:(NSString *)eventID;


```

* Invoking player actions (sendNotification):
Tell the player to do something, such as play or pause.

```

/*!
 * @function sendNotification:expressionID:forName
 *
 * @abstract
 * Notifies the player on specific events
 *
 * @param NSString notificationName, notification name
 * @param NSString params, json string for passing parameters to the controls layer (webview).
 */
- (void)sendNotification:(NSString *)notificationName withParams:(NSString *)params;


```
* Retrieving information in runtime (evaluate):
Find out something about a player, such as the media that is loaded in the player and flashVars that the player passes.

```

/*!
 * @function asyncEvaluate:expressionID:handler
 *
 * @abstract
 * Evaluates values from the player
 *
 * @param NSString expression, @"{mediaProxy.entry.thumbnailUrl}:
 * @param NSString expressionID, expression id use for several expressions.
 * @param handler Callback with the value of the expression.
 */
- (void)asyncEvaluate:(NSString *)expression expressionID:(NSString *)expressionID handler:(void(^)(NSString *value))handler;


```
* Changing player attributes in runtime (setKDPAttribute):
Modify player attributes, such as a label on a player UI.

```

/*!
 * @function setKDPAttribute:propertyName:value
 *
 * @abstract
 * Controls elements in the player layer
 *
 * @param NSString pluginName, represents specific element
 * @param NSString propertyName, property of the plugin
 * @param NSString value, sets the property
 */
- (void)setKDPAttribute:(NSString *)pluginName propertyName:(NSString *)propertyName value:(NSString *)value;


```

## Receiving Notification when the Player API Is Ready

```


/*!
 * @function registerReadyEvent
 *
 * @abstract
 * Registers to the players ready event
 *
 * @discussion
 * The registerReadyEvent function will notify that the player has been loaded
 * and it's possible to interact with it.
 *
 * Calls to registerReadyEvent will invoke the handler when the player is ready
 *
 *
 * @param handler
 * Callback for the ready event.
 *
 */
- (void)registerReadyEvent:(void(^)())handler;


```

## Using the player API's Base Methods

[Player API Using Demo]()
