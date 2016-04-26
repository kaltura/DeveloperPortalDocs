---
layout: page
title: Kaltura Player SDK API - Properties, Events, Notifications - iOS
subcat: iOS
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios)

This article describes how to use the iOS Player API base methods to manage properties, events, and notifications. 

## Using the Kaltura iOS player API Base Methods
You can access the entire Player API through methods that enable the following functions.

* Listen and respond to Player events (addJsListener/removeJsListener): Enables you to react to internal player events, such as beginning, playing, and pausing:

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

* Invoke player actions (sendNotification): Enables you to tell the Player to do something, such as play or pause:

```objective_c

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
* Retrieve information in runtime (evaluate): Enables you to find out something about a Player, such as the media that is loaded in the Player and flashVars that the player passes:

```objective_c

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
* Change Player attributes in runtime (setKDPAttribute): Modifies Player attributes, such as a label on a Player UI:

```objective_c

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
To receive a notification when the Player API is ready, use the following objective:

```objective_c
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

## Using the Player API Base Methods
To use the Player API base methods, use the following objective:

```objective_c
/*!
 @method        play:
 @abstract      Initiates playback of the current item. (required)
 
 If playback was previously paused, this method resumes playback where it left off; otherwise, this method plays the first available item, from the beginning.
 If a Kaltura Player is not prepared for playback when you call this method, this method first prepares the Kaltura Player and then starts playback. To minimize playback delay, call the prepareToPlay method before you call this method.
 */
- (void)play;
```

```objective_c
/*!
 @method        pause:
 @abstract      Pauses playback of the current item. (required)
 
 If playback is not currently underway, this method has no effect. To resume playback of the current item from the pause point, call the play method.
 */
- (void)pause;
```

```objective_c
/*!
 @method        replay:
 @abstract      replay playback of the current item. (required)
 
 This method initiates playback from the beginning of the current item.
 */
- (void)replay;

```

```objective_c
/*!
 @method        seek:
 @abstract      Begins seeking through the media content.
 */
- (void)seek:(NSTimeInterval)playbackTime;
```

```objective_c
/*!
 @method        seek:completionHandler:
 @abstract      Begins seeking through the media content.
 */
- (void)seek:(NSTimeInterval)playbackTime completionHandler:(void(^)())handler;
```

## Player States
The following are the available Player states. 


### KPMediaPlaybackState

```objective_c
typedef NS_ENUM(NSInteger, KPMediaPlaybackState) {
    KPMediaPlaybackStateUnknown,
    KPMediaPlaybackStateLoaded,
    KPMediaPlaybackStateReady,
    /* Playback is currently under way. */
    KPMediaPlaybackStatePlaying,
    /* Playback is currently paused. */
    KPMediaPlaybackStatePaused,
    /* Playback is currently ended. */
    KPMediaPlaybackStateEnded,
    ///@todo
    /* Playback is temporarily interrupted, perhaps because the buffer ran out of content. */
    KPMediaPlaybackStateInterrupted,
    /* The movie player is currently seeking towards the end of the movie. */
    KPMediaPlaybackStateSeekingForward,
    /* The movie player is currently seeking towards the beginning of the movie. */
    KPMediaPlaybackStateSeekingBackward
};

```

### KPMediaLoadState

```objective_c
typedef NS_OPTIONS(NSUInteger, KPMediaLoadState) {
    /* The load state is not known. */
    KPMediaLoadStateUnknown        = 0,
    /* The buffer has enough data that playback can begin, but it may run out of data before playback finishes. */
    KPMediaLoadStatePlayable       = 1 << 0,
    /* Enough data has been buffered for playback to continue uninterrupted. */
    KPMediaLoadStatePlaythroughOK  = 1 << 1, // Playback will be automatically started in this state when shouldAutoplay is YES
    /* The buffering of data has stalled. */
    KPMediaLoadStateStalled        = 1 << 2, // Playback will be automatically paused in this state, if started
};
```


