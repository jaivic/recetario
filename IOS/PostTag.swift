struct PostTag: Codable {

    var id: Int
    var post_id: Int
    var tag_id: Int

    var posts: [Post]
    var tags: [Tag]
}
