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
    name = "glydeSpider"
    allowed_domains = ["glyde.com"]
    start_urls = ["http://glyde.com/buy/used-phones-browse-all/?page="+str(n)+"&bs_only=false&sort_order=release_date" for n in range(1,15)]

    # def start_requests(self):
    #     startURL = "http://allrecipes.com/recipes/87/everyday-cooking/vegetarian/"
    #     for i in range(1,100):
    #         yield scrapy.Request(startURL+"?page="+str(i), self.parse)

    def parse(self, response):
        # recipeList = response.xpath('//article/a/@href').extract()
        # for recipe in recipeList:
        #     request = scrapy.Request("http://allrecipes.com"+recipe, callback=self.parse_recipe)
        #     yield request
        phoneNameList = [x.lstrip().rstrip() for x in response.xpath('//div[contains(@class, "glu-info")]/div[contains(@class, "display-title font-13")]/div[contains(@class, "full")]/text()').extract()]
        phoneSpecList = [x.lstrip().rstrip() for x in response.xpath('//div[contains(@class, "medium grey-text margin-top-5")]/text()').extract()]
        phoneDollarList = [x.lstrip().rstrip() for x in response.xpath('//div[contains(@class, "best-price font-700")]/span[contains(@class, "amount font-24")]/text()').extract()]
        phoneCentList = [x.lstrip().rstrip() for x in response.xpath('//div[contains(@class, "best-price font-700")]/span[contains(@class, "cents font-11")]/text()').extract()]
        with open('glydeUsedPrices.csv', 'a') as usedPrices:
            csvWriter = csv.writer(usedPrices)
            rows = zip(phoneNameList, phoneSpecList, phoneDollarList, phoneCentList)
            for row in rows:
                csvWriter.writerow(row)
            



    # def parse_recipe(self, response):
    #     filename = "recipes2/"+response.url.split("/")[-2] + '.html'
    #     ingredList = ' '.join(response.xpath('//span[contains(@class, "recipe-ingred_txt added")]/text()').extract())
    #     ingredList = ingredList.replace(",", " ")
    #     ingredList = ingredList.replace(".", " ")
    #     prepTime = response.xpath('//span[contains(@class, "ready-in-time")]/text()').extract()[1]
    #     prepTime = ''.join(c for c in prepTime if c.isdigit())
    #     if " egg " not in ingredList and " eggs " not in ingredList and int(prepTime) < 59: 
    #         with open(filename, 'wb') as f:
    #             f.write(response.body)
