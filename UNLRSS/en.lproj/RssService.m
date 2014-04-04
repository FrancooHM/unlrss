//
//  RssService.m
//  UNLRSS
//
//  Created by Franco Agustín Rabaglia on 15/02/14.
//  Copyright (c) 2014 Franco Agustín Rabaglia. All rights reserved.
//

#import "RssService.h"

@implementation RssService

- (void)getRssMainItemsWithBlock:(RssServiceAPIServiceResponseCompletitionBlock) block{
    
    //Instancio el manager de la peticion HTTP.
    AFHTTPRequestOperationManager *manager = [AFHTTPRequestOperationManager manager];
    [manager.securityPolicy setAllowInvalidCertificates:YES];
    [manager setResponseSerializer:[AFJSONResponseSerializer serializer]];
    [manager setRequestSerializer:[AFJSONRequestSerializer serializer]];
    [manager.responseSerializer setAcceptableContentTypes:[NSSet setWithObject:@"application/json"]];
    
    //_SELF_REALLY_WEAK_
    
    //Genero la URL del Web service.
    NSString *URLString = @"http://servicios.rectorado.unl.edu.ar/unlmedios/news/getNews/ciencia/5/page:1";
    [manager GET:URLString parameters:nil
     
     //En caso de exito sucede lo siguiente:
         success:^(AFHTTPRequestOperation *operation, id responseObject) {
             
             NSMutableArray *items = [@[] mutableCopy];
             
             //Extraigo la noticia
             
             items = @[@{
                           ItemKeyTitle:[[[responseObject objectAtIndex:0] objectForKey:@"News"] objectForKey:@"title"],
                           ItemKeyVolanta:[[[responseObject objectAtIndex:0] objectForKey:@"News"] objectForKey:@"volanta"],
                           ItemKeyBody:[[[responseObject objectAtIndex:0]  objectForKey:@"News"] objectForKey:@"body"],
                           ItemKeyCopete:[[[responseObject objectAtIndex:0] objectForKey:@"News"] objectForKey:@"copete"]}
                            ];
             
             //TODO: Agregar verificacion de contenido multimedia.
             block(items, nil);
         }
     
     //En caso de error sucede lo siguiente:
         failure:^(AFHTTPRequestOperation *operation, NSError *error) {
             
             block(nil, error);
             
         }];

}
@end
