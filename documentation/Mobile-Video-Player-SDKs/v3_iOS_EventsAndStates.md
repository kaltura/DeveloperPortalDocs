---
layout: page
---

## Player Events and States  

To receive notifications about any player-related events or states, you can add observers to the relevant events as follows.

### Observing Events   

>swift

```swift
player.addObserver(self, events: [PlayerEvent.durationChanged]) { event in
    print(event.duration) 
}

```
>objc

```objc

- (void)addPlayerObservers {
    // add observer to list of different events
    [self.kPlayer addObserver:self events:@[PlayerEvent.playing, PlayerEvent.durationChanged, PlayerEvent.stateChanged] block:^(PKEvent * _Nonnull event) {
        if ([event isKindOfClass:PlayerEvent.playing]) {
            NSLog(@"playing %@", event);
        } else if ([event isKindOfClass:PlayerEvent.durationChanged]) {
            NSLog(@"duration: %@", event.duration);
        } else if ([event isKindOfClass:PlayerEvent.stateChanged]) {
            NSLog(@"old state: %ld", (long)event.oldState);
            NSLog(@"new state: %ld", (long)event.newState);
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

[self.kPlayer removeObserver:self events:@[PlayerEvent.playing]];

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

