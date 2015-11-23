import scrapy
import re
import urlparse
import os
import csv

from scrapy.spiders import CrawlSpider, Rule
#from scrapy.contrib.linkextractors.sgml import SgmlLinkExtractor
from scrapy.selector import HtmlXPathSelector
from scrapy.linkextractors import LinkExtractor

class DmozSpider(scrapy.Spider):
    name = "reviewSpider"
    allowed_domains = ["youtube.com"]
    #MKBHD start_urls = ["https://www.youtube.com/playlist?list=PLBsP89CPrMeNm71T5gYC6jebm9vPbLBiP"]
    start_urls = ["https://www.youtube.com/playlist?list=PLD228B91CC610B805"]

    # def start_requests(self):
    #     startURL = "http://allrecipes.com/recipes/87/everyday-cooking/vegetarian/"
    #     for i in range(1,100):
    #         yield scrapy.Request(startURL+"?page="+str(i), self.parse)

    def parse(self, response):
        # recipeList = response.xpath('//article/a/@href').extract()
        # for recipe in recipeList:
        #     request = scrapy.Request("http://allrecipes.com"+recipe, callback=self.parse_recipe)
        #     yield request
        phoneNameList = [x.lstrip().rstrip() for x in response.xpath('//a[contains(@class, "pl-video-title-link yt-uix-tile-link yt-uix-sessionlink  spf-link ")]/text()').extract()]
        reviewLinkList = [x.lstrip().rstrip() for x in response.xpath('//a[contains(@class, "pl-video-title-link yt-uix-tile-link yt-uix-sessionlink  spf-link ")]/@href').extract()]
        with open('mobileTechReviews.csv', 'a') as mkReviews:
            csvWriter = csv.writer(mkReviews)
            rows = zip(phoneNameList, reviewLinkList)
            for row in rows:
                csvWriter.writerow(row)