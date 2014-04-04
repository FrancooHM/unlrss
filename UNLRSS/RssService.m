//
//  RssService.m
//  UNLRSS
//
//  Created by Franco Agustín Rabaglia on 15/02/14.
//  Copyright (c) 2014 Franco Agustín Rabaglia. All rights reserved.
//

#import "RssService.h"
#import "Configs.h"
@implementation RssService

@synthesize image;
@synthesize oError;

- (void)getRssMainItemsFromURL:(NSString*) URLString WithBlock:(RssAPIServiceResponseCompletitionBlock) block andPageNumber:(NSNumber*) pageNumber{
    
    //Instancio el manager de la peticion HTTP.
    AFHTTPRequestOperationManager *manager = [AFHTTPRequestOperationManager manager];
    [manager.securityPolicy setAllowInvalidCertificates:YES];
    [manager setResponseSerializer:[AFJSONResponseSerializer serializer]];
    [manager setRequestSerializer:[AFJSONRequestSerializer serializer]];
    [manager.responseSerializer setAcceptableContentTypes:[NSSet setWithObject:@"application/json"]];
    
    [manager GET:URLString parameters:nil
     
     //En caso de exito sucede lo siguiente:
         success:^(AFHTTPRequestOperation *operation, id responseObject) {
             
             NSMutableArray *items = [@[] mutableCopy];
             NSMutableArray *arrayMediafile = [@[] mutableCopy];
             NSMutableDictionary *dictMediafile = [@{} mutableCopy];
             NSString *pathMediafile = @"";
             NSString *imageName = @"";
             NSString *imageURL = @"";
             self.image = [[UIImage alloc] init];

             //This loop keeps the code robust although changing the notice quantity. It proces all of them.
             for (int i = 0; i<[responseObject count]; i++) {
                 //Extracting pathMediafile
                 arrayMediafile = [[[responseObject objectAtIndex:i]objectForKey:ItemKeyArrayMediafile] mutableCopy];
                 
                 //Sometimes this array is empty
                 if([arrayMediafile count]==1){
                     //Breaking down the file path.
                     dictMediafile = [[arrayMediafile objectAtIndex:0] mutableCopy];
                     
                     pathMediafile = [dictMediafile objectForKey:@"path"];
//                     NSLog(@"Image file path: %@", pathMediafile);
                     
                     //OMG!
                     NSArray *pathComponents = [pathMediafile pathComponents];
                     imageName = [pathComponents objectAtIndex:2];
//                     NSLog(@"Image file name: %@", imageName);
                     
                     //Generating the URL for image file petition
                     imageURL = [MediaURL stringByAppendingFormat:@"%@", imageName];
//                     NSLog(@"Image URL: %@", imageURL);
                     
                     //Extracting and adding all other objects.
                     [items addObject:@{
                                        ItemKeyTitle:[[[responseObject objectAtIndex:i] objectForKey:@"News"] objectForKey:ItemKeyTitle],
                                        ItemKeyVolanta:[[[responseObject objectAtIndex:i] objectForKey:@"News"] objectForKey:ItemKeyVolanta],
                                        ItemKeyBody:[[[responseObject objectAtIndex:i]  objectForKey:@"News"] objectForKey:ItemKeyBody],
                                        ItemKeyCopete:[[[responseObject objectAtIndex:i] objectForKey:@"News"] objectForKey:ItemKeyCopete],
                                        ItemKeyImage: imageURL}];
                    }
                    else{
                        [items addObject:@{
                                           ItemKeyTitle:[[[responseObject objectAtIndex:i] objectForKey:@"News"] objectForKey:ItemKeyTitle],
                                           ItemKeyVolanta:[[[responseObject objectAtIndex:i] objectForKey:@"News"] objectForKey:ItemKeyVolanta],
                                           ItemKeyBody:[[[responseObject objectAtIndex:i]  objectForKey:@"News"] objectForKey:ItemKeyBody],
                                           ItemKeyCopete:[[[responseObject objectAtIndex:i] objectForKey:@"News"] objectForKey:ItemKeyCopete],
                                           ItemKeyImage: @""}];
                    }
                 

             }
             
             //TODO: Agregar verificacion de contenido multimedia.
             block(items, nil);
         }
     
     //En caso de error sucede lo siguiente:
         failure:^(AFHTTPRequestOperation *operation, NSError *error) {
             
             block(nil, error);
             
         }];

}
@end
