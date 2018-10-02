# Wordpress-Anti-Spam
This plugin connects to Vakavic Text classifier API(دسته‌گر) to prevent publication of spam or inappropriate comments in your Wordpress wensite

=== Vakavic-Anti-Spam ===
Contributors: VakavicAi
Tags: comments, spam, textclassify, NLP, filter,
Requires at least: 4.6
Tested up to: 4.7
Stable tag: 4.3
Requires PHP: 5.2.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

یکی از افزونه‌هایی که که ما در واکاویک برای استفاده در سرویس‌های دیگر آماده کرده ایم، پلاگین نظارت خودکار بر کامنت‌ها در وردپرس است. در این صفحه روش نصب و استفاده از این پلاگین تشریح شده است.

== Description ==

یکی از افزونه‌هایی که که ما در واکاویک برای استفاده در سرویس‌های دیگر آماده کرده ایم، پلاگین نظارت خودکار بر کامنت‌ها در وردپرس است. در این صفحه روش نصب و استفاده از این پلاگین تشریح شده است.

نحوه عملکرد
عملکرد این پلاگین به این شکل است که پس از نصب آن در وردپرس، هر کامنتی که توسط کاربران و بازدیدکنندگان سایت شما ثبت می‌شود، با استفاده از سرویس‌های واکاویک پردازش و بررسی می‌شود، در صورتی که کامنت ثبت شده شامل لغات توهین آمیز و زشت نباشد، کامنت به صورت خودکار منتشر می‌شود و در غیر اینصورت به صورت خودکار به پوشه Spam یا Not Approved(در انتظار تایید) منتقل می‌شود.

در نتیجه با استفاده از این افزونه، شما می‌توانید در تنظیمات وردپرس، انتشار کامنت‌ها را روی «انتشار خودکار» قرار بدهید و مطمئن باشید کامنتی که حاوی کلمات یا محتوای غیر قابل انتشار است در وبسایت شما منتشر نخواهد شد. از این پلاگین در دو وضعیت پیش فرش و پیشرفته می توانید استفاده کنید.

== Installation ==

This section describes how to install the plugin and get it working.

استفاده از پلاگین با تنظیمات پیشفرض<br/>
برای استفاده از این افزونه مراحل زیر را طی کنید<br/>
1-	<br/>فایل پلاگین را دانلود و نصب کنید
2-	<br/>در بخش ادمین وردپرس وارد شوید و از منو بخش افزونه‌ها را انتخاب کنید
3-	<br/>روش بارگزاری افزونه را انتخاب کنید و فایل دانلود شده را آنجا آپلود کنید
<br/>
4-	پس از نصب، گزینه «فعال کردن افزونه» را انتخاب کنید تا افزونه فعال شود.
<br/>
<br/>5-	به بخش «دیدگاه‌ها» بروید
<br/>6-	در بخش منوی ادمین، زیر بخش دیدگاه‌ها یک بخش به نام «تنظیمات واکاویک» اضافه شده است. روی آن کلیک کنید تا وارد بخش تنظیمات مربوط به افزونه شوید
<br/>7-	در این بخش دو ورودی اصلی مشاهده می‌کنید
. API Key و Reference Key. 
این دو مقدار را از حساب کاربری خود در واکاویک باید مشخص کنید.
8-	اگر حساب کاربری در واکاویک ندارید یک حساب کاربری بسازید و وارد حساب خود شوید.<br/>
9-	از منوی سمت راست گزینه «تنظیمات حساب کاربری» را انتخاب کنید. در صفحه ای که باز می‌شود کلید “API” خود را مشاهده می‌کنید. مقدار آن را کپی کنید و در صفحه تنظیمات واکاویک در ادمین وردپرس، در ورودی اول (API KEY) وارد کنید.<br/>
10-	<br/>در سایت واکاویک مطابق راهنمای ساخت ماژول، یک ماژول دسته‌گر بسازید
11-	در صفحه ماژول خود، در تب «رکوردها و برچسب‌ها: گزینه «افزودن رکورد از دیتاست‌های عمومی واکاویک» را انتخاب کنید. از لیست دیتاست‌های آماده، دیتاست «نظارت هوشمند بر کامنت‌های وردپرس» را انتخاب کنید و صبر کنید تا دیتاست اضافه شود. (برای استفاده از دیتاست‌های عمومی واکاویک، می‌توانید از این راهنما استفاده کنید.<br/>
12-	پس از اضافه شدن دیتاست، در صفحه ماژول، از باکس مربوط به وضعیت آموزش « انجام آموزش» را انتخاب کنید و چند لحظه صبر کنید تا آموزش به صورت کامل انجام شود.<br/>
13-	وارد تب «مشخصات و تنظیمات ماژول» شوید. در این بخش کد یکتای ماژول خود یا همان Reference Key را مشاهده می‌کنید. مقدار آن را کپی کنید و در ورودی دوم بخش تنظیمات پلاگین واکاویک در وردپرس (Reference key) آن را وارد کنید.<br/>
14-	در بخش تنظیمات پلاگین واکاویک، می‌توانید انتخاب کنید کامنت‌هایی که قابل انتشار نیستند به کدام پوشه منتقل شوند، Spam یا Not Approved (جفنگ یا در انتظار تایید)<br/>
15-	کلید ذخیره تنظیمات را بزنید.<br/>


== Frequently Asked Questions ==


== Screenshots ==

1.screenshot-1.JPG  
2.screenshot-2.JPG  
the screenshot is taken from the directory that contains the stable readme.txt

== Changelog ==

= 1.0 =
* List versions from most recent at top to oldest at bottom.

== Upgrade Notice ==



