//
//  RssService.h
//  UNLRSS
//
//  Created by Franco Agustín Rabaglia on 15/02/14.
//  Copyright (c) 2014 Franco Agustín Rabaglia. All rights reserved.
//

#import <Foundation/Foundation.h>
#import "AFNetworking.h"

typedef void (^RssAPIServiceResponseCompletitionBlock)(id returnedObject, NSError *error);

@interface RssService : NSObject

@property (nonatomic,strong) UIImage *image;
@property (nonatomic, strong) NSError *oError;

- (void)getRssMainItemsFromURL:(NSString*) URLString WithBlock:(RssAPIServiceResponseCompletitionBlock) block andPageNumber:(NSNumber*) pageNumber;

@end
