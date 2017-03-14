---
layout: page
---

## Player Events and States  

To receive notifications about any player-related events or states, you can add observers to the relevant events as follows.

### Observing Events   

>swift

```swift
// add observer to list of different events
player.addObserver(self, events: [PlayerEvent.playing, PlayerEvent.durationChanged, PlayerEvent.stateChanged]) { event in
     if type(of: event) == PlayerEvent.playing {
        // handle playing event
     } else if type(of: event) == PlayerEvent.durationChanged {
        let duration = event.duration
     } else if type(of: event) == PlayerEvent.stateChanged {
        let newState = event.newState
        let oldState = event.oldState
     }
}

```
>objc

```objc
// add observer to list of different events
[self.kPlayer addObserver:self events:@[PlayerEvent.playing, PlayerEvent.durationChanged, PlayerEvent.stateChanged] block:^(PKEvent * _Nonnull event) {
    if ([event isKindOfClass:PlayerEvent.playing]) {
        // handle playing event
    } else if ([event isKindOfClass:PlayerEvent.durationChanged]) {
        NSNumber *duration = event.duration;
    } else if ([event isKindOfClass:PlayerEvent.stateChanged]) {
        PlayerState oldState = event.oldState;
        PlayerState newState = event.newState;
    }
}];
```

### Removing Observers

>swift

```swift
player.removeObserver(self, events: [PlayerEvent.playing])
```
>objc

```objc
[self.player removeObserver:self events:@[PlayerEvent.playing]];
```

>Note: To get a complete list of supported player events, refer to the [Player Events page](https://kaltura.github.io/playkit/api/ios/Classes/PlayerEvents.html).

### Observing States  

>swift

```swift
func addEvents() {
    // observe single event
    self.playerController.addObserver(self, events: [PlayerEvent.stateChanged]) { event in
        // handle state changed event
    }
    
    // observe array of events
    self.playerController.addObserver(self, events: [PlayerEvent.playing, PlayerEvent.pause]) { event in
        if type(of: event) == PlayerEvent.playing {
            // handle playing event
        } else {
            // handle pause event
        }
    }
}
```

>objc

```objc
- (void)addEvents {
    // observe single event
    [self.player addObserver:self events:@[PlayerEvent.stateChanged] block:^(PKEvent * _Nonnull event) {
        // handle state changed event
    }];
    
    // observe array of events
    [self.player addObserver:self events:@[PlayerEvent.playing, PlayerEvent.pause] block:^(PKEvent * _Nonnull event) {
        if ([event isKindOfClass:PlayerEvent.playing]) {
            // handle playing event
        } else {
            // handle pause event
        }
    }];
}
```

>Note: To get a complete list of supported player states, refer to the [Player States page](https://kaltura.github.io/playkit/api/ios/Enums/PlayerState.html).

### Observing Timed Metadata

Observe timed metadata and filter by key. 
for more ways how to handle metadata see [AVMetadataItem](https://developer.apple.com/reference/avfoundation/avmetadataitem)

>swift

```swift
self.player.addObserver(self, events: [PlayerEvent.timedMetadata]) { event in
    if let timedMetadata: [AVMetadataItem] = event.timedMetadata { 
        // filter the array by specific key
        let filteredMetadata = AVMetadataItem.metadataItems(from: timedMetadata, withKey: "YOUR_KEY", keySpace: nil)
        // get values from metadata with the type you need
        for metadataItem in filteredMetadata {
            let stringValue = metadataItem.stringValue
            let dataValue = metadataItem.dataValue
            let dateValue = metadataItem.dateValue
            let numberValue = metadataItem.numberValue
        }
    }
}
```

>objc

```objc
[self.player addObserver:self events:@[PlayerEvent.timedMetadata] block:^(PKEvent * _Nonnull event) {
    NSArray<AVMetadataItem *> *timedMetadata = event.timedMetadata;
    if (timedMetadata) {
        // filter the array by specific key
        NSArray<AVMetadataItem *> *filteredMetadata = [AVMetadataItem metadataItemsFromArray:timedMetadata withKey:@"YOUR_KEY" keySpace:nil];
        // get values from metadata with the type you need
        for (AVMetadataItem * metadataItem in filteredMetadata) {
            NSString *stringValue = metadataItem.stringValue;
            NSData *dataValue = metadataItem.dataValue;
            NSDate *dateValue = metadataItem.dateValue;
            NSNumber *numberValue = metadataItem.numberValue;
        }
    }
}];
```


## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.

