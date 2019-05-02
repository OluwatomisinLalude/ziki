# ziki

ziki is a blogging service like wordpress it runs on your own self-hosted domain. Think of it as a distributed social network.
It does not run on a url like `medium.com/markessien` or `wordpress.com/markessien`. I can install ziki on my own personal domain and set up my own blog.

I can install ziki on `markessien.com` or on a custom domain of my choosing.

Ziki relies on the use of two terms:

`Owner` and `Guest`

## The owner

This is the person that downloaded ziki and installed it on their domain. The owner has permission to view their timeline, write and publish posts and follow other `ziki` users' posts using RSS. The owner only has an additional link called `timeline` which is private. The owner can choose to make their timeline public.

## The Guest

This is the person visiting a `ziki` site. When on the site, the users can view posts by the site [owner](##The-owner). If a guest wants to interact with the posts i.e like or comment they can login to the site to access these privilleges. If the site uses [disqus](https://disqus.com/) for commenting, the guest has no access to native login only the site [owner](##The-owner) does.

### Contributing

- Make sure you have setup your `PHP` development environment
- Ensure `composer` is setup on your development environment
- Fork your own copy of the repository
- Clone it
- Run `composer install --no-dev`
- Run `php -S localhost:8000`.
- In your browser, go to `localhost:8000` to view the website.

#### The Pull Request Template:

```
PR Title: <one-line desciption of your changes>

**Changes**
- descibe first change
- describe more changes (if necessary)
- ...

**Testing**
Describe how to test the changes you've made. For example, if
you added a logout button to the timeline page:
Visit `localhost:8000/timeline` and click on the logout button.

**Other Info**
Add any info that may be necessary. This section is not required.

**Screenshots**
Add if appropriate. Screenshots are needed for most front end work.
```

#### Pull Request Example:

```
**Changes**
- Add a logout button to the timeline page

**Testing**
Visit `localhost:8000/timeline` and click on the logout button
at the top right corner of the page.

**Other Info**
N/A

**Screenshots**
A screenshot would be added here showing the button on the page.
```
