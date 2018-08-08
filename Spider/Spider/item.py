import scrapy

class SpiderItem(scrapy.Item):
    #define the fields for your item here like:
    book_url = scrapy.Field()
    book_name = scrapy.Field()
    book_author = scrapy.Field()
    book_abstract = scrapy.Field()
    book_chapter_name = scrapy.Field()
    book_chapter_url = scrapy.Field()
    book_chapter_content = scrapy.Field()