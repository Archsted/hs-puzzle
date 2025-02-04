
# color は red green blue yellow のいずれか
# direction は Up Down Left Right のいずれか

class Board
    attr_accessor :board

    PIECES = [
        [
            [0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,1,0,0,0,1,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,1,7,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,1,1,1,0,0,0,1],
            [0,0,0,0,0,0,0,0,0,0,0,0,0,0,9,1],
            [0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1],
            [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
            [1,1,0,0,0,0,0,1,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,0,5,1,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,1,1,1,0,0,0,1,1,1,0,0],
            [0,0,0,0,0,0,0,0,0,0,0,1,6,0,0,0],
            [0,1,1,1,0,0,0,0,0,0,0,1,0,0,0,0],
            [0,0,8,1,0,0,0,0,0,0,0,0,0,0,0,0],
            [0,0,0,1,0,0,0,0,0,0,0,0,0,1,1,1],
            [0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1]
        ],
        [
            [0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,1,1,1,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,1,8,0,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,1,0,0,0,1,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,1,7,0,0,0,0,0],
            [1,1,0,1,1,1,0,0,0,1,1,1,0,0,0,0],
            [0,0,0,0,5,1,0,0,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,1,0,0,0,1,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,6,1,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,1,1,1,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1],
            [0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1]
        ],
        [
            [0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0],
            [0,0,0,1,0,0,0,1,1,1,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,6,1,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
            [0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
            [0,1,5,0,0,0,0,0,0,0,0,0,0,0,0,0],
            [0,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,1,1,1,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,1,8,0,0,0,0,0],
            [1,1,0,0,0,0,0,1,0,1,0,0,0,0,0,0],
            [0,0,0,0,0,0,7,1,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,1,1,1,0,0,0,0,0,1,1,1],
            [0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1]
        ],
        [
            [0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0],
            [0,0,0,1,0,1,1,1,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,1,6,0,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0],
            [0,0,0,0,0,0,0,0,0,0,0,0,8,1,0,0],
            [0,1,0,0,0,0,0,0,0,0,0,1,1,1,0,0],
            [0,1,5,0,0,0,0,0,0,0,0,0,0,0,0,0],
            [0,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,1,1,1,0,0,0,0,0,0],
            [0,0,0,0,0,0,0,0,7,1,0,0,0,0,0,0],
            [1,1,0,0,0,0,0,0,0,1,0,0,0,1,1,1],
            [0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1]
        ]
    ]

    def create(ids)
        @board = Array.new(31){Array.new(31)}

        ids.each {|mid|
            piece = PIECES[mid - 1]

            piece.map.with_index {|row,h|
                row.map.with_index{|cell, w|
                    @board[h][w] = cell
                }
            }

            self.rotate
        }

        self.enclose

        @board
    end

    def rotate
        t_board = Array.new(31){Array.new(31)}

        @board.map.with_index{|row,h|
            row.map.with_index{|cell,w|
                t_board[30 - w][h] = @board[h][w]
            }
        }

        @board = t_board
    end

    def enclose
        @board.map.with_index{|row,h|
            @board[h].unshift 1
            @board[h].push 1
        }

        encloseRow = [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1]

        @board.unshift encloseRow
        @board.push encloseRow
    end

end








class Solver
  attr_accessor :state, :udon, :field, :red, :yellow, :blue, :green
  UDON = :udon
  WALL = :wall
  RED = :red
  YELLOW = :yellow
  BLUE = :blue
  GREEN = :green
  def initialize(map, udonh, udonw, udonc, rh, rw, gh, gw, bh, bw, yh, yw)
    @state = Array.new(33){Array.new(33)}
    @field = Array.new(33){Array.new(33)}

    33.times do |i|
      33.times do |j|
        if map[i][j] == 1 then
            @state[i][j] = WALL
            @field[i][j] = WALL
        end
      end
    end

    @udon = {
      position: [udonh,udonw],
      color: udonc
    }
    @state[udonh][udonw] = UDON
    @field[udonh][udonw] = UDON

    @red = [rh,rw]
    @state[rh][rw] = RED

    @green = [gh,gw]
    @state[gh][gw] = GREEN

    @blue = [bh,bw]
    @state[bh][bw] = BLUE

    @yellow = [yh,yw]
    @state[yh][yw] = YELLOW
  end

  def aa_tip(st)
    case st
    when WALL
      "#"
    when RED
      "r"
    when YELLOW
      "y"
    when BLUE
      "b"
    when GREEN
      "g"
    when UDON
      "u"
    else
      " "
    end
  end

  def map_aa
     @state.map{|l|l.map{|x| self.aa_tip(x)}.join}.join("\n")
  end

  def show
    vals = []
    vals << map_aa
    # vals << @udon
    # vals << @red
    # vals << @yellow
    # vals << @blue
    # vals << @green

    puts vals
  end

  def solve
    c = %w{red green blue yellow}.index @udon[:color]
    if c == nil
        p "invalid color"
        exit
    end
    #c ||= rand(4)
    ai = AI.new(@field.map{|l| l.map{|x| x==WALL ? 1 : 0}}, c, @udon[:position])
    m, h = ai.solve(@red, @green, @blue, @yellow)
    mm = h[m]
    ar = []
    # mm -> mの順
    while mm
      mm.zip(m).each.with_index do |pair,i|
        be, af = pair
        a = af[0] - be[0]
        b = af[1] - be[1]

        i = %w{red green blue yellow}[i]

        if a > 0
          ar.unshift [i,"Down"]
          break
        end
        if a < 0
          ar.unshift [i,"Up"]
          break
        end
        if b > 0
          ar.unshift [i,"Right"]
          break
        end
        if b < 0
          ar.unshift [i,"Left"]
          break
        end
      end
      m = mm
      mm = h[mm]
    end
    ar
  end

end

class AI
  def initialize(f,c,u)
    @f = f
    @c = c
    @u = u
  end

  def solve(r,g,b,y)
    # hには一つ前のものが入る
    h = {[r,g,b,y] => nil}
    poses = [[r,g,b,y]]
    until poses.empty?
      nexts = []
      poses.each do |pos|
        moves(pos).each do |m|
          unless h.key? m
            nexts << m
            h[m] = pos
            if m[@c] == @u
              return [m,h]
            end
          end
        end
      end
      poses = nexts

    end
  end

  def moves(pos)
    ar = []
    [[-1,0],[0,-1],[0,1],[1,0]].each do |u,v|
      pos.each.with_index do |a,k|
        i,j = a
        ii = i
        jj = j
        s = 0
        until (@f[ii+u][jj+v] == 1) || pos.include?([ii+2*u,jj+2*v])
          ii += 2*u
          jj += 2*v
          s += 1
        end

        unless s == 0
          x = pos.dup
          x[k] = [ii,jj]
          ar << x
        end
      end
    end
    ar
  end
end


tmap = [
    [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],
    [1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,1],
    [1,0,0,0,0,0,0,0,1,1,1,0,0,0,1,0,0,0,0,0,0,0,1,1,1,0,0,0,1,0,0,0,1],
    [1,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,1],
    [1,1,1,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,1],
    [1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1],
    [1,0,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,1],
    [1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,1],
    [1,0,1,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1,0,1],
    [1,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1],
    [1,0,0,0,0,0,0,0,0,0,0,0,1,1,1,0,0,0,0,0,1,1,1,0,0,0,0,0,0,0,0,0,1],
    [1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,1],
    [1,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,0,1,1,1],
    [1,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,1],
    [1,0,0,0,0,0,1,1,1,0,0,0,0,0,1,1,1,1,1,0,0,0,0,0,1,1,1,0,0,0,0,0,1],
    [1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,1],
    [1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,1],
    [1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,1],
    [1,0,0,0,1,0,0,0,0,0,0,0,0,0,1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,1],
    [1,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1],
    [1,0,1,1,1,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,1,1,1],
    [1,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,1],
    [1,0,0,0,0,0,1,1,1,0,0,0,1,1,1,0,0,0,0,0,1,1,1,0,1,1,1,0,0,0,0,0,1],
    [1,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,1],
    [1,1,1,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,1,0,0,0,1],
    [1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,1],
    [1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1,0,0,0,0,0,1,1,1,0,1,1,1,0,0,0,1],
    [1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,1],
    [1,0,0,0,0,0,0,0,0,0,1,1,1,0,0,0,1,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,1],
    [1,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1],
    [1,0,0,0,0,0,1,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,1],
    [1,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,1],
    [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1]
    ];


udon_h = ARGV[1].to_i
udon_w = ARGV[2].to_i
udon_color = ARGV[3]

red_h = ARGV[4].to_i
red_w = ARGV[5].to_i
green_h = ARGV[6].to_i
green_w = ARGV[7].to_i
blue_h = ARGV[8].to_i
blue_w = ARGV[9].to_i
yellow_h = ARGV[10].to_i
yellow_w = ARGV[11].to_i

boardIds = ARGV[0].split(",").map!{|item| item.to_i}

step = 999
minsv = nil
minar = nil

if udon_color == "black"
    colors = %w{red green blue yellow}
else
    colors = [udon_color]
end

# p colors


board = Board.new.create(boardIds)

colors.each{|cc|
    sv = Solver.new(board, udon_h, udon_w, cc, red_h, red_w, green_h, green_w, blue_h, blue_w, yellow_h, yellow_w)
    # p sv.show
    ar = sv.solve
    # p ar
    if ar.count < step
        step = ar.count
        minsv = sv
        minar = ar
    end
}

p step
# p minsv.show
# p minar
exit
minar.each do |x|
  i, d = x
#      p i,d
#      move(driver, i,d)
end
exit
