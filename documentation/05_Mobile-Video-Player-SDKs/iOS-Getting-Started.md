---
layout: page
title: iOS Player SDK Getting Started 
subcat: iOS
weight: 108
---

[![iOS](https://img.shields.io/badge/iOS-Supported-green.svg)](https://github.com/kaltura/player-sdk-native-ios) 

## Getting Started

KalturaPlayerSDK can be added to any project (big or small) in a matter of minutes (maybe even seconds if you are an advanced user). 

## Installing the Kaltura iOS Player SDK
There are two options for installing the Kaltura iOS Player SDK:

* Using fully supported CocoaPods

* SDK traditional installation


## SDK CocoaPods Installation

The easiest way to install KalturaPlayerSDK is to use {% extlink CocoaPods https://cocoapods.org/ %}. To do so, simply add the following line to your Podfile:

```
pod 'KalturaPlayerSDK'
```




## SDK Traditional Installation
To install the Kaltura iOS Player SDK using the traditional installation, follow these steps:
```
git clone https://github.com/kaltura/player-sdk-native-ios.git
```

### Step 1: Add the Static Library's .xcodeproj to the Application's Project
1. Locate the ```KALTURAPlayerSDK.xcodeproj``` from the subproject folder in Finder, and drag it into the Xcode’s Navigator tree. Alternatively, add it with the Xcode’s Add Files File menu item. ![add xcodeproj](https://camo.githubusercontent.com/1e3d845d0728b62beb23e474ae30d2b8370867db/687474703a2f2f6b6e6f776c656467652e6b616c747572612e636f6d2f73697465732f64656661756c742f66696c65732f7374796c65732f6c617267652f7075626c69632f6164645f66696c65732e706e67)

2. Make sure to add the ```KALTURAPlayerSDK.xcodeproj``` file only, **not the entire directory**. You cannot have the same project open in two different Xcode windows. If you find that you are unable to navigate around the library project, verify that you do not have it open in another Xcode window.
3. After you have added the subproject, it should appear below the main project in the Xcode’s Navigator tree:
![Xcode navigator tree](https://camo.githubusercontent.com/1f46c83ca7f3e9c76f1509ddc041e3964e63f3c7/687474703a2f2f6b6e6f776c656467652e6b616c747572612e636f6d2f73697465732f64656661756c742f66696c65732f7374796c65732f6c617267652f7075626c69632f78636f6465747265652e706e67)

### Step 2: Configure the Application Target to Build the Static Library Target
1. You will need to get the main project to build and link to the ```KALTURAPlayerSDK``` library.
2. In the main project application’s target settings, find the ```Build Phases``` section. This is where you will configure the ```KALTURAPlayerSDK``` target to automatically build and link to the ```KALTURAPlayerSDK ``` library.
3. After you find the ```Build Phases``` section, open the ```Target Dependencies``` block and click the ```+```button. 
4. In the hierarchy presented to you, the ```KALTURAPlayerSDK``` target from the ```KALTURAPlayerSDK``` project should be listed. Select it and click ```add```.

![Xcode target config](https://camo.githubusercontent.com/d35c79ce9a0d01ad3a45a94362da413ed4afa403/687474703a2f2f6b6e6f776c656467652e6b616c747572612e636f6d2f73697465732f64656661756c742f66696c65732f7374796c65732f6c617267652f7075626c69632f616464446570656e64656e6369652e6a7067)

### Step 3: Configure the Application Target to Link to the Static Library Target
1. You will need to set the application to link to the library when it is built - just like you would a system framework you want to use. 
2. Open the ```Link Binary With Libraries``` section slightly below the ```Target Dependencies``` section, and click ```+``` there as well. 
3. At the top of the list there should be the ```libKALTURAPlayerSDK.a``` static library that the main project target produces. 
4. Choose it and click ```Add```.
![Xcode target config2](https://camo.githubusercontent.com/acea3bcfbe47b0cc2e37796807d23c617723822f/687474703a2f2f6b6e6f776c656467652e6b616c747572612e636f6d2f73697465732f64656661756c742f66696c65732f7374796c65732f6c617267652f7075626c69632f6c696e6b546f53444b2e6a7067)
2. Because we are using Objective-C, you will need to add a couple of linker flags to the main project application’s target to ensure that ObjC static libraries like ours are linked correctly. In the main project target’s ```Build Settings``` find the ```Other Linker Flags``` line, and add ```-ObjC```.
![Xcode objC flag](https://camo.githubusercontent.com/a79c30cac8e6ff20b85c2db05391fb5888706966/687474703a2f2f6b6e6f776c656467652e6b616c747572612e636f6d2f73697465732f64656661756c742f66696c65732f7374796c65732f6c617267652f7075626c69632f616464696e674f626a435f666c61672e6a7067)

### Step 4: Add a Resources Bundle

1. Choose the application target from the Targets section.
2. Go to the ```Products``` folder and drag the ```KALTURAPlayerSDK.bundle``` to ```Copy Bundle Resources``` section.

![Adding resource bundle](https://camo.githubusercontent.com/bd7958d4ca8e7c7ce8ca1dac1a6b1c1c6c08c078/687474703a2f2f6b6e6f776c656467652e6b616c747572612e636f6d2f73697465732f64656661756c742f66696c65732f7374796c65732f6c617267652f7075626c69632f42756e646c652e706e67)

**Note:** If you click build now, you will see that the PlayerSDK library is built before the main project app, and that they are linked together.

### Required Frameworks
```
• SystemConfiguration
• QuartzCore
• CoreMedia
• AVFoundation
• AudioToolbox
• AdSupport
• WebKit
• Social
• MediaAccessibility
• libSystem.dylib
• libz.dylib
• libstdc++.dylib
• libstdc++.6.dylib
• libstdc++.6.0.9.dylib
• libxml2.dylib
• libxml2.2.dylib
• libc++.dylib
```

### App Transport Security 
Detailed information about the Application Transport Security can be found here: [App Transport Security](https://github.com/kaltura/DeveloperPortalDocs/blob/master/documentation/05_Mobile-Video-Player-SDKs/Troubleshooting.md).


## iOS Player SDK Basic Embedding  
This section describes how to use the iOS Player SDK basic embedding.

### Import KPViewController to the Main Project

```
#import <KALTURAPlayerSDK/KPViewController.h>
```

### Create a KPViewController Instance

```
@property (retain, nonatomic) KPViewController *player;
```

### Initialize PlayerViewController for Fullscreen

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


### Initialize PlayerViewController for Inline
To initialize the PlayerViewController for inline, refer to [Inline player](https://github.com/kaltura/DeveloperPortalDocs/blob/master/documentation/05_Mobile-Video-Player-SDKs/Fullscreen-inline-iOS.md).
