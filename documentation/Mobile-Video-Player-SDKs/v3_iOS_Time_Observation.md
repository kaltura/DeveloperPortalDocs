---
layout: page
---

# Time Observation

The player provides an API to add periodic and boundary observers with a max deviation of 100ms.

>Note: **The observers are not removed when changing media** only on destroy/deinit, this means that boundary observers that are not relevant for next media should be removed. </br></br> The best practice is removing all boundary observers on changing media and adding the new boundary observers needed. 

>Improtant: Make sure to add observers after player is ready to play (`canPlay` event). 

## Periodic Observation

Periodic observation can be made in 100ms intervals.

Correct values: 1.0s, 1.1s, 2.5s etc.

Intervals which are not divisible by 100ms are floored to the first decimal place: </br>
1.155 => 1.1 </br>
2.464 => 2.4

Negative values are will not work and should not be used.

### Usage

In order to add periodic observation you need to provide the interval, dispatch queue to observe on (**optional**, providing nil will use main queue) and block handler to handle each periodic event.
When adding a new observation you will receive a uuid used as a token that with it you can remove the observation later.

Swift API:

````swift
// add periodic observation
let token = player.addPeriodicObserver(interval: 1, observeOn: nil) { (time) in
    // handle time observation
}
// remove single periodic observation using token
player.removePeriodicObserver(token)
// remove all periodic observations
player.removePeriodicObservers()
````

ObjC API:

````objc
// add periodic observation
NSUUID *token = [player addPeriodicObserverWithInterval:1.0f observeOn:nil using:^(NSTimeInterval time) {
        // handle time here
}];
// remove single periodic observation using token
[player removePeriodicObserver:token];
// remove all periodic observations
[player removePeriodicObservers];
````

## Boundary Observation

Boundary observation can be added by percentage or by time.
For example if we want to observe midpoint we will add observation for 50% and if we want to observe user reach 60 seconds we will use time boundary for 60s.

### Usage

In order to add boundary observers you need to provide the boundary in percentage or time, dispatch queue to observe on (**optional**, providing nil will use main queue) and block handler to handle the boundaries event. 

Swift API:

````swift
// boundary factory used to create boundaries
let boundaryFactory = PKBoundaryFactory(duration: player.duration)
// 2 boundaries, one for 60 seconds and one for 50% 
let boundaries: [PKBoundary] = [boundaryFactory.timeBoundary(boundaryTime: 60), boundaryFactory.percentageTimeBoundary(boundary: 50)]
// add the boundary observer
let token = player.addBoundaryObserver(boundaries: boundaries, observeOn: nil) { (time, percentage) in
    // handle boundary event
}
// remove single boundary observation using token
player.removeBoundaryObserver(token)
// remove all boundary observations
player.removeBoundaryObservers()
````

ObjC API:

````objc
// boundary factory used to create boundaries
PKBoundaryFactory *boundaryFactory = [[PKBoundaryFactory alloc] initWithDuration:player.duration];
// 2 boundaries, one for 60 seconds and one for 50% 
NSArray<PKBoundary> *boundaries = @[[boundaryFactory timeBoundaryWithBoundaryTime:60.0f], [boundaryFactory percentageTimeBoundaryWithBoundary:50]];
// add the boundary observer
NSUUID *token = [player addBoundaryObserverWithBoundaries:boundaries observeOn:nil using:^(NSTimeInterval time, double percentage) {
    // handle boundary observation
}];
// remove single boundary observation using token
[player removeBoundaryObserver:token];
// remove all boundary observations
[player removePeriodicObservers];
````
