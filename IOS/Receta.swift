struct Receta: Codable {

    var id: Int
    var name: String
    var procedimiento_id: Int?
    var categoria_id: Int?
    var created_at: String?
    var updated_at: String?

    var procedimientos: [Procedimiento]
    var categorias: [Categoria]
}
