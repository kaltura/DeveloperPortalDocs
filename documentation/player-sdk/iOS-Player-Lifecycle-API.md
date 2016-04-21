---
layout: page
title: iOS Player Lifecycle API
---
# Player Lifecycle API

When creating KPViewController instance, you should use following API to manage the Lifecycle of this instance.

## How to Create KPViewController instance?

After Player Creation:

```objective_c    
-(instancetype)initWithConfiguration:(KPPlayerConfig *)configuration;
```

## How to Remove player instance?

```objective_c        
-(void)removePlayer;
```

## How to Reset player instance?

Means player is live and ready for changeConfiguration

```objective_c    
-(void)resetPlayer;
```

## How to Change configuration?
 
Load a new config object to old player instance   
**(ONLY if you resetPlayer before)**

```objective_c    
-(void)changeConfiguration:(KPPlayerConfig *)config;
```

## How to Release and save position?

Means saving the position of player when switching between views since it will be opened again (must call resume player when opening again)

```objective_c   
-(void)releaseAndSavePosition;
```

## How to Resume player?

Means, player was released and saved position, now it will be resumed.

```objective_c   
-(void)resumePlayer;
```