---
layout: page
---

## Player Events and States  

To receive notifications about any player-related events or states, you can add observers to the relevant events as follows.

### Observing Events   

>swift

```swift


```
>objc

```objc

- (void)addPlayerObservers {
    // add observer to list of different events
    [self.kPlayer addObserver:self events:@[PlayerEvent_playing.self, PlayerEvent_pause.self, PlayerEvent_durationChanged.self, PlayerEvent_stateChanged.self] block:^(PKEvent * _Nonnull event) {
        if ([event isKindOfClass:PlayerEvent_playing.class]) {
            NSLog(@"---------> playing %@", event);
        } else if ([event isKindOfClass:PlayerEvent_pause.class]) {
            NSLog(@"---------> paused %@", event);
        } else if ([event isKindOfClass:PlayerEvent_durationChanged.class]) {
            NSLog(@"---------> duration change: %f", ((PlayerEvent_durationChanged*)event).duration);
        } else {
            NSLog(@"event: %@", event);
        }
    }];
    
    // add observer to one event
    [self.kPlayer addObserver:self events:@[PlayerEvent_playing.self] block:^(PKEvent * _Nonnull event) {
        if ([event isKindOfClass:PlayerEvent_playing.class]) {
            NSLog(@"---------> playing %@", event);
        } else {
            NSLog(@"event: %@", event);
        }
    }];
}

```

### Removing Observers

>swift

```swift


```
>objc

```objc

- (void)removePlayerObservers {
    // remove observer to list of different events
    [self.kPlayer removeObserver:self events:@[PlayerEvent_playing.self, PlayerEvent_pause.self, PlayerEvent_durationChanged.self, PlayerEvent_stateChanged.self]];
    
    // remove one event observation
    [self.kPlayer removeObserver:self events:@[PlayerEvent_playing.self]];
}

```

>Note: To get a complete list of supported player events, refer to the [Player Events page](https://kaltura.github.io/playkit/api/ios/Classes/PlayerEvents.html).

### Observing States  

>swift

```swift


```
>objc

```objc

- (void)addStateChangeObserver {
    [self.kPlayer addObserver:self events:@[PlayerEvent_playing.self, PlayerEvent_pause.self, PlayerEvent_durationChanged.self, PlayerEvent_stateChanged.self] block:^(PKEvent * _Nonnull event) {
        if ([event isKindOfClass:PlayerEvent_stateChanged.class]) {
            NSLog(@"---------> newState: %ld", (long)((PlayerEvent_stateChanged*)event).newState);
            NSLog(@"---------> oldState: %ld", (long)((PlayerEvent_stateChanged*)event).oldState);
        } else {
            NSLog(@"event: %@", event);
        }
    }];
}

```

>Note: To get a complete list of supported player states, refer to the [Player States page](https://kaltura.github.io/playkit/api/ios/Enums/PlayerState.html).



## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.

