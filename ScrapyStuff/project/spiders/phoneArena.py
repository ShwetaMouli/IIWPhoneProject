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
    name = "phoneArenaSpider"
    allowed_domains = ["phonearena.com"]
    start_urls = ["http://www.phonearena.com/phones/sort/popular#/phones/page/"+str(n)+"/sort/popular" for n in range(1,4)]

    # def start_requests(self):
    #     startURL = "http://allrecipes.com/recipes/87/everyday-cooking/vegetarian/"
    #     for i in range(1,100):
    #         yield scrapy.Request(startURL+"?page="+str(i), self.parse)

    def parse(self, response):
        phoneList = response.xpath('//div[contains(@class, "s_block_4 s_block_4_s115    clearfix")]/a/@href').extract()
        phoneNames = response.xpath('//div[contains(@class, "s_block_4 s_block_4_s115    clearfix")]/div/a/span[contains(@class,"title")]/text()').extract()
        for phone in phoneList:
            request = scrapy.Request("http://phonearena.com"+phone, callback=self.parse_phone)
            yield request
        # with open('phoneList.csv','a') as phones:
        #     for (phone1,phone2) in zip(phoneNames,phoneList):
        #         phones.write(phone1+'\t'+phone2+'\n')

        # phoneNameList = [x.lstrip().rstrip() for x in response.xpath('//div[contains(@class, "glu-info")]/div[contains(@class, "display-title font-13")]/div[contains(@class, "full")]/text()').extract()]
        # phoneSpecList = [x.lstrip().rstrip() for x in response.xpath('//div[contains(@class, "medium grey-text margin-top-5")]/text()').extract()]
        # phoneDollarList = [x.lstrip().rstrip() for x in response.xpath('//div[contains(@class, "best-price font-700")]/span[contains(@class, "amount font-24")]/text()').extract()]
        # phoneCentList = [x.lstrip().rstrip() for x in response.xpath('//div[contains(@class, "best-price font-700")]/span[contains(@class, "cents font-11")]/text()').extract()]
        # with open('glydeUsedPrices.csv', 'a') as usedPrices:
        #     csvWriter = csv.writer(usedPrices)
        #     rows = zip(phoneNameList, phoneSpecList, phoneDollarList, phoneCentList)
        #     for row in rows:
        #         csvWriter.writerow(row)
            



    # def parse_phone(self, response):
    #     filename = "PhoneSpecs.csv"
    #     ingredList = ' '.join(response.xpath('//span[contains(@class, "recipe-ingred_txt added")]/text()').extract())
    #     ingredList = ingredList.replace(",", " ")
    #     ingredList = ingredList.replace(".", " ")
    #     prepTime = response.xpath('//span[contains(@class, "ready-in-time")]/text()').extract()[1]
    #     prepTime = ''.join(c for c in prepTime if c.isdigit())
    #     if " egg " not in ingredList and " eggs " not in ingredList and int(prepTime) < 59: 
    #         with open(filename, 'wb') as f:
    #             f.write(response.body)
