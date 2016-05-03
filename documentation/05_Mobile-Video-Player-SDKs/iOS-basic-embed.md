---
layout: page
title: iOS Player SDK Basic Embedding  
---
[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 

This article describes how to use the iOS Player SDK basic embedding.

## Import KPViewController to the Main Project

```
#import <KALTURAPlayerSDK/KPViewController.h>
```

## Create a KPViewController Instance

```
@property (retain, nonatomic) KPViewController *player;
```

## Initialize PlayerViewController for Fullscreen

``` objc 
- (KPViewController *)player {
    if (!_player) {
        // Account Params
        KPPlayerConfig *config = [[KPPlayerConfig alloc] initWithServer:@"http://cdnapi.kaltura.com"
                                                         uiConfID:@"26698911"
                                                         partnerId:@"1831271"];
        
        
        // Video Entry
        config.entryId =  @"1_o426d3i4";
        
        // Setting this property will cache the html pages in the limit size
        config.cacheSize = 0.8;
        _player = [[KPViewController alloc] initWithConfiguration:config];
    }
    return _player;
}

- (void)viewDidAppear:(BOOL)animated {
    [super viewDidAppear:animated];
    [self presentViewController:self.player animated:YES completion:nil];
}
```
![iOS-fullscreen](./images/iOS-fullscreen-embed.png)


## Initialize PlayerViewController for Inline
To initialize the PlayerViewController for inline, refer to [Inline player](Fullscreen-inline-iOS).

