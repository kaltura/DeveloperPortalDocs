---
layout: page
title: iOS Player Lifecycle API
---
# Player Lifecycle API

When creating a KPViewController instance, you should use following API to manage the lifecycle of this instance.

## How to Create a KPViewController Instance
After creating the Player, implement the following objective:

```objective_c    
-(instancetype)initWithConfiguration:(KPPlayerConfig *)configuration;
```

## How to Remove a Player Instance
To remove an instance, implement the following objective:
```objective_c        
-(void)removePlayer;
```

## How to Reset a Player Instance
Resetting a Player instance means that the Player is live and ready for a changeConfiguration:

```objective_c    
-(void)resetPlayer;
```

## How to Change the Configuration
To change the configuration, load a new config object to the old Player instance:   
**(ONLY if you resetPlayer before)**

```objective_c    
-(void)changeConfiguration:(KPPlayerConfig *)config;
```

## How to Release and Save position?
This option enables you to save the position of the Player when switching between views, since the Player will be opened again (you will need to call Resume Player when opening again - see below for details):

```objective_c   
-(void)releaseAndSavePosition;
```

## How to Resume a Player
When a Player is released and its position saved, this option resumes the Player:

```objective_c   
-(void)resumePlayer;
```
