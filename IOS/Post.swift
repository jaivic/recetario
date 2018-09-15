struct Post: Codable {

    var id: Int
    var user_id: Int
    var title: String
    var slug: String
    var body: String
    var type: Bool
    var image: String?
    var postback: String
    var visits: Int
    var likes: Int
    var status: Bool
    var created_at: String?
    var updated_at: String?

    var categories: [Category]
    var tags: [Tag]
    var users: [User]
}
