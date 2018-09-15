struct Comment: Codable {

    var id: Int
    var post_id: Int
    var user_id: Int
    var comment: String
    var approved: Bool
    var created_at: String?
    var updated_at: String?

    var posts: [Post]
    var users: [User]
}
