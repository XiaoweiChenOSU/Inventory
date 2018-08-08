import scrapy
from Spider.item import SpiderItem


class BookSpider(scrapy.Spider):
    name = "book"
    allowed_domains = ['ybdu.com']
    url = 'https://www.ybdu.com/book1/0/'
    offset = 1
    start_urls = [url + str(offset) + '/']

    def parse(self, response):
        book = response.xpath('//div[@class="clearfix rec_rullist"]/ul')
        book_url_list = book.xpath('./li[@class="two"]/a/@href').extract()
        book_name_list = book.xpath('./li[@class="two"]/a/text()').extract()
        book_author_list = book.xpath('./li[@class="four"]/a/text()').extract()

        for each_url, name, author in zip(book_url_list, book_name_list, book_author_list):
            item = SpiderItem()
            text = each_url
            item['book_url'] = each_url
            item['book_name'] = name[:len(name)-4]
            item['book_author'] = author
            yield scrapy.Request(text, callback=self.book_solve,meta={'item':item})

    def book_solve(self, response):
        item = response.meta['item']
        book_abstract_list = response.xpath('//div[@class="mu_contain"]/p/text()').extract()
        book_chapter_url_list = response.xpath('//div[@class="mu_contain"]/ul/li/a/@herf').extract()
        book_chapter_name_list = response.xpath('//div[@class="mu_contian"]/ul/li/a/text()').extract()
        
