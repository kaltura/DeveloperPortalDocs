---
layout: page
title: Plugins
subcat: SDK 3.0 - iOS
weight: 516
---

This article describes how to create plugins, which enable you to add certain functionalities to your player.

## When Should You Use Plugins?

You'll want to create and use plugins to add core feature to Kaltura's Video Player SDK for iOS. 

>Note: Plugins creation is supported for swift only (can only create plugin classes in Swift and not in Objective-C).

## Creating a Plugin Configuration Class  

**What is a plugin configuration?** A plugin configuration is *any* object that can contain any data required by your plugin. This section will show you how to create a plugin configuration class and provide you with some examples.

### Plugin Configuration Sample  
>swift

```swift
class SamplePluginConfig {
    var data: Any?
    var param: Any?
}
```

### When to Pass the Plugin Configuration  

The plugin configuration is passed via the `load` function, explained in [adding plugin configuration](#add-the-plugin-configuration).

## Building Plugins  

To build plugins, create a class that inherits from `BasePlugin`:

>swift

```swift
import PlayKit

class SamplePlugin: BasePlugin {
    
    public override class var pluginName: String {
        return "YouboraPlugin"
    }
    
    // override other methods according to needs.
}
```

## Register the Plugin

You should register the plugin once on your `AppDelegate` or see below:

>swift

```swift
import UIKit
import PlayKit

@UIApplicationMain
class AppDelegate: UIResponder, UIApplicationDelegate {

    func application(_ application: UIApplication, didFinishLaunchingWithOptions launchOptions: [UIApplicationLaunchOptionsKey: Any]?) -> Bool {
        PlayKitManager.shared.registerPlugin(IMAPlugin.self)
        return true
    }
    
    ...
    
}
```

>objc

```objc
#import "AppDelegate.h"
#import "PlayKit-Swift.h"

@implementation AppDelegate

- (BOOL)application:(UIApplication *)application didFinishLaunchingWithOptions:(NSDictionary *)launchOptions {
    [[PlayKitManager sharedInstance] registerPlugin:SamplePlugin.self];
    return YES;
}

...

@end
```

## Add The Plugin Configuration

> [Read About PluginConfig]()

To get your plugin's configuration, you'll need to add it to the `pluginConfig` instance as follows.

>swift

```swift
var plugins = [String: AnyObject]()
        
let samplePluginConfig = SamplePluginConfig()
samplePluginConfig.data = {your_content}
        
plugins[SamplePlugin.pluginName] = samplePluginConfig
        
// Create PluginConfig
let config = PluginConfig(config: plugins)
        
do {
    // Load the player with the created config
    player = try PlayKitManager.shared.loadPlayer(pluginConfig: pluginConfig)
} catch let e {
    // error loading the player
}
```

>objc

```objc
NSMutableDictionary *plugins = [[NSMutableDictionary alloc] init];

SamplePluginConfig *samplePluginConfig = [[SamplePluginConfig alloc] init];
samplePluginConfig.data = {your_content}

plugins[SamplePlugin.pluginName] = samplePluginConfig;

// Create PluginConfig
[[PluginConfig alloc] initWithConfig:plugins];

// Load the player with the created config
NSError *error = nil;
player = [[PlayKitManager sharedInstance] loadPlayerWithPluginConfig:pluginConfig error:&error];

if (!error) {
    // use the player
} else {
    // error loading the player
}
```

## Update Plugin Configuration

To update the plugin configuration you will need to have an updated plugin config object. 
It is important to update the config in the time after stopping the current media and before preparing the next one.

>swift

```swift
player.updatePluginConfig(pluginName: SamplePlugin.pluginName, config: samplePluginConfig)
```
>objc

```objc
[player updatePluginConfigWithPluginName:SamplePlugin.pluginName config: samplePluginConfig];
```

## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
